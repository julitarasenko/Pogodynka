<?php

namespace App\Service;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\WeatherRepository;

class WeatherUtil
{
    public function getWeatherForCountryAndCity(string $country_name, 
                                                string $city_name, 
                                                CityRepository $cityRepository, 
                                                WeatherRepository $weatherRepository): array {
        $city = $cityRepository->findCityByCountryAndCityName($country_name, $city_name);
        $result = $this->getWeatherForLocation($city, $weatherRepository);
        return $result;
    }

    public function getWeatherForLocation(City $city, WeatherRepository $weatherRepository): array
    {
        $weather = $weatherRepository->findByCity($city);
        $cityAndWeather = array(
            "city" => $city,
            "weather" => $weather
        );

        return $cityAndWeather;
    }
}