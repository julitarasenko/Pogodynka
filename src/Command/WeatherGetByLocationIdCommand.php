<?php

namespace App\Command;

use App\Repository\CityRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'weather:getByLocationId',
    description: 'Provides measurements for a specific location by its id',
)]
class WeatherGetByLocationIdCommand extends Command
{
    private CityRepository $cityRepository;
    private WeatherUtil $weatherUtil;

    public function __construct(CityRepository $cityRepository, WeatherUtil $weatherUtil, string $name = null)
    {
        $this->cityRepository = $cityRepository;
        $this->weatherUtil = $weatherUtil;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('locationId', InputArgument::REQUIRED, 'City ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $locationId = $input->getArgument('locationId');
        $city = $this->cityRepository->find($locationId);
        $cityAndWeather = $this->weatherUtil->getWeatherForLocation($city);
        
        $output->writeln("Country: " . $city->getCountryName());
        $output->writeln("City: " . $city->getCityName());
        foreach($cityAndWeather["weather"] as $weather) {
            $output->writeln("Date: " . json_encode($weather->getDate()));
            $output->writeln("Temperature: " . $weather->getTemperature());
        }

        return Command::SUCCESS;
    }
}