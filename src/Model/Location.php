<?php

namespace Bigyohann\TestMatawan\Model;

use Bigyohann\TestMatawan\Enums\LocationTypeEnum;

readonly class Location
{
    public function __construct(
        private string  $name,
        private string  $city,
        private string  $country,
        private ?string $gate = null,
        private ? LocationTypeEnum $type = null,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getGate(): ?string
    {
        return $this->gate;
    }

    public function getType(): ?LocationTypeEnum
    {
        return $this->type;
    }
}