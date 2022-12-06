<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:getByCountryAndCityName',
    description: 'Provides measurements for a specific location by its country and city names',
)]
class WeatherGetByCountryAndCityNameCommand extends Command
{
    private WeatherUtil $weatherUtil;
    
    public function __construct(WeatherUtil $weatherUtil, string $name = null)
    {
        $this->weatherUtil = $weatherUtil;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('countryName', InputArgument::REQUIRED, 'Country name')
            ->addArgument('cityName', InputArgument::REQUIRED, 'City name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $countryName = $input->getArgument('countryName');
        $cityName = $input->getArgument('cityName');
        $cityAndWeather = $this->weatherUtil->getWeatherForCountryAndCity($countryName, $cityName);

        $output->writeln("Country: " . $cityAndWeather["city"]->getCountryName());
        $output->writeln("City: " . $cityAndWeather["city"]->getCityName());
        foreach($cityAndWeather["weather"] as $weather) {
            $output->writeln("Date: " . json_encode($weather->getDate()));
            $output->writeln("Temperature: " . $weather->getTemperature());
        }

        return Command::SUCCESS;
    }
}