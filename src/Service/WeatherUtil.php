<?php

namespace App\Service;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\WeatherRepository;

class WeatherUtil
{
    private CityRepository $cityRepository;
    private WeatherRepository $weatherRepository;

    public function __construct(CityRepository $cityRepository, WeatherRepository $weatherRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->weatherRepository = $weatherRepository;
    }

    public function getWeatherForCountryAndCity(string $country_name, string $city_name): array {
        $city = $this->cityRepository->findByCountryAndCity($country_name, $city_name);
        $result = $this->getWeatherForLocation($city);
        return $result;
    }

    public function getWeatherForLocation(City $city): array
    {
        $weather = $this->weatherRepository->findByCity($city);
        $cityAndWeather = array(
            "city" => $city,
            "weather" => $weather
        );

        return $cityAndWeather;
    }
}