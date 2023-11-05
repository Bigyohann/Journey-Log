<?php

use Bigyohann\TestMatawan\Enums\LocationTypeEnum;
use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Bigyohann\TestMatawan\Model\Transportation;
use Bigyohann\TestMatawan\Services\JourneySorter;

require_once __DIR__ . '/../vendor/autoload.php';


$boardingCards = [
    new BoardingCard(
        new Location(
            name: 'Barcelona',
            city: 'Barcelona',
            country: 'Spain',
        ),
        new Location(
            name: 'Gerona Airport',
            city: 'Gerona',
            country: 'Spain',
            type: LocationTypeEnum::AIRPORT,
        ),
        new Transportation(
            type: TransportationEnum::BUS,
            name: 'airport bus',
        ),
    ),
    new BoardingCard(
        new Location(
            name: 'Gerona Airport',
            city: 'Gerona',
            country: 'Spain',
            gate: '45B',
        ),
        new Location(
            name: 'Stockholm',
            city: 'Stockholm',
            country: 'Sweden',
        ),
        new Transportation(
            type: TransportationEnum::FLIGHT,
            name: 'SK455',
        ),
        seatAssignment: '3A',
        baggageDrop: '344',
    ),
    new BoardingCard(
        new Location(
            name: 'Stockholm',
            city: 'Stockholm',
            country: 'Sweden',
            gate: '22',
        ),
        new Location(
            name: 'New York JFK',
            city: 'New York',
            country: 'USA',
        ),
        new Transportation(
            type: TransportationEnum::FLIGHT,
            name: 'SK22',
        ),
        seatAssignment: '7B',
    ),
    new BoardingCard(
        new Location(
            name: 'Madrid',
            city: 'Madrid',
            country: 'Spain',
        ),
        new Location(
            name: 'Barcelona',
            city: 'Barcelona',
            country: 'Spain',
        ),
        new Transportation(
            type: TransportationEnum::TRAIN,
            name: '78A',
        ),
        seatAssignment: '45B'
    ),
];


$journey = new JourneySorter($boardingCards);
$array = $journey->generateJourneyLog();
foreach ($array as $item) {
    print ($item . PHP_EOL);
}


