<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $temperature = null;

    #[ORM\Column(nullable: true)]
    private ?int $image_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0', nullable: true)]
    private ?string $temperature_feel = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sunrise = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sunset = null;

    #[ORM\Column(nullable: true)]
    private ?float $wind_speed = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $precipitation = null;

    #[ORM\Column(nullable: true)]
    private ?float $humidity = null;

    #[ORM\Column(nullable: true)]
    private ?int $pressure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getImageId(): ?int
    {
        return $this->image_id;
    }

    public function setImageId(?int $image_id): self
    {
        $this->image_id = $image_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTemperatureFeel(): ?string
    {
        return $this->temperature_feel;
    }

    public function setTemperatureFeel(?string $temperature_feel): self
    {
        $this->temperature_feel = $temperature_feel;

        return $this;
    }

    public function getSunrise(): ?\DateTimeInterface
    {
        return $this->sunrise;
    }

    public function setSunrise(?\DateTimeInterface $sunrise): self
    {
        $this->sunrise = $sunrise;

        return $this;
    }

    public function getSunset(): ?\DateTimeInterface
    {
        return $this->sunset;
    }

    public function setSunset(?\DateTimeInterface $sunset): self
    {
        $this->sunset = $sunset;

        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->wind_speed;
    }

    public function setWindSpeed(?float $wind_speed): self
    {
        $this->wind_speed = $wind_speed;

        return $this;
    }

    public function getPrecipitation(): ?string
    {
        return $this->precipitation;
    }

    public function setPrecipitation(?string $precipitation): self
    {
        $this->precipitation = $precipitation;

        return $this;
    }

    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    public function setHumidity(?float $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function setPressure(?int $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }
}
