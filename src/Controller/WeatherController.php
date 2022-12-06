<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\City;
use App\Repository\WeatherRepository;
use App\Repository\CityRepository;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    public function cityAction(string $country_name,
                               string $city_name,
                               WeatherRepository $weatherRepository,
                               CityRepository $cityRepository,
                               WeatherUtil $weatherUtil): Response {
        $cityAndWeather = $weatherUtil->getWeatherForCountryAndCity($country_name, $city_name);
        return $this->render('weather/city.html.twig', [
            'city' => $cityAndWeather["city"],
            'weather' => $cityAndWeather["weather"]
        ]);
    }

}

