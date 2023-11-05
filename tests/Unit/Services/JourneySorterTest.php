<?php

use Bigyohann\TestMatawan\Enums\LocationTypeEnum;
use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Exceptions\NoDestinationExistException;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Bigyohann\TestMatawan\Model\Transportation;
use Bigyohann\TestMatawan\Services\JourneySorter;

test( 'it should sort boarding cards and not match initial array', function (array $boardingCards) {
    $journeySorter = new JourneySorter($boardingCards);
    expect($journeySorter->getSortedBoardingCards())
        ->toBeArray()
        ->not()->toMatchArray(
            $boardingCards,
            'Boarding cards should be sorted so they are not the same as the original array'
        )
        ->toBe($journeySorter->getSortedBoardingCards());
})->with([
    "badSortedArray" => [
        [
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
                baggageDrop: '334',
            ),
            new BoardingCard(
                new Location(
                    name: 'New York JFK',
                    city: 'New York',
                    country: 'USA',
                ),
                new Location(
                    name: 'Paris',
                    city: 'Paris',
                    country: 'France',
                ),
                new Transportation(
                    type: TransportationEnum::FLIGHT,
                    name: 'SK22',
                ),
                seatAssignment: '7B',
                baggageDrop: '334',
            ),
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
        ],
    ],
    "badSortedArray 2" =>
        [
            [
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
                    baggageDrop: '334',
                ),
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
                        name: 'New York JFK',
                        city: 'New York',
                        country: 'USA',
                    ),
                    new Location(
                        name: 'Paris',
                        city: 'Paris',
                        country: 'France',
                    ),
                    new Transportation(
                        type: TransportationEnum::FLIGHT,
                        name: 'SK22',
                    ),
                    seatAssignment: '7B',
                    baggageDrop: '334',
                ),
            ]
        ]
]);

test('it should match given array well sorted', function (array $boardingCards) {
    $journeySorter = new JourneySorter($boardingCards);
    expect($journeySorter->getSortedBoardingCards())
        ->toBeArray()
        ->toMatchArray(
            $boardingCards,
            'Boarding cards should be sorted so they are the same as the original array'
        );
})->with([
    'goodSortedArray' => [[
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
            baggageDrop: '334',
        ),
        new BoardingCard(
            new Location(
                name: 'New York JFK',
                city: 'New York',
                country: 'USA',
            ),
            new Location(
                name: 'Paris',
                city: 'Paris',
                country: 'France',
            ),
            new Transportation(
                type: TransportationEnum::FLIGHT,
                name: 'SK22',
            ),
            seatAssignment: '7B',
            baggageDrop: '334',
        ),
    ]],
    'secondGoodSortedArray' => [
        [
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
                baggageDrop: '334',
            ),
        ]
    ]
]);

test('it should throw an error when no destination is found', function (array $boardingCards) {
    new JourneySorter($boardingCards);
})->with([
    'noDestinationFound' => [[
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
                name: 'Paris',
                city: 'Paris',
                country: 'France',
                gate: '45B',
            ),
            new Location(
                name: 'Paris',
                city: 'Paris',
                country: 'Paris',
            ),
            new Transportation(
                type: TransportationEnum::FLIGHT,
                name: 'SK455',
            ),
            seatAssignment: '3A',
            baggageDrop: '344',
        ),
    ]]
])->throws(NoDestinationExistException::class);