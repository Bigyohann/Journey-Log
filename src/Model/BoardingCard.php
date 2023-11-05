<?php

namespace Bigyohann\TestMatawan\Model;

readonly class BoardingCard
{
    public function __construct(
        private Location $source,
        private Location $destination,
        private Transportation $transportation,
        private ?string $seatAssignment = null,
        private ?string $baggageDrop = null)
    {
    }

    public function getSeatAssignment(): ?string
    {
        return $this->seatAssignment;
    }

    public function getBaggageDrop(): ?string
    {
        return $this->baggageDrop;
    }

    public function getTransportation(): Transportation
    {
        return $this->transportation;
    }

    public function getDestination(): Location
    {
        return $this->destination;
    }

    public function getSource(): Location
    {
        return $this->source;
    }
}