<?php

use Bigyohann\TestMatawan\Enums\LocationTypeEnum;
use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Formatter\BoardingCardFormatter;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Bigyohann\TestMatawan\Model\Transportation;

test('it should write a step of journey', function (BoardingCard $boardingCard, string $expected) {
    $formatter = new BoardingCardFormatter();
    expect($formatter->format($boardingCard))
        ->toBe($expected);
})->with([
        'train' => [
            new BoardingCard(
                new Location('Nice airport', 'Nice', 'France'),
                new Location('Paris airport', 'Paris', 'France'),
                new Transportation(TransportationEnum::TRAIN, '78A'),
                '45B',
                '344'
            ),
            'Take train 78A from Nice airport to Paris airport. Sit in seat 45B.'
        ],
        'bus' => [
            new BoardingCard(
                new Location('Nice airport', 'Nice', 'France'),
                new Location('Paris airport', 'Paris', 'France', '45B', type: LocationTypeEnum::AIRPORT),
                new Transportation(TransportationEnum::BUS, '78A'),
                '45B',
                '344'
            ),
            'Take the airport bus from Nice airport to Paris airport. Sit in seat 45B.'
        ],
        'flight' => [
            new BoardingCard(
                new Location('Nice airport', 'Nice', 'France', '45B'),
                new Location('Paris airport', 'Paris', 'France', type: LocationTypeEnum::AIRPORT),
                new Transportation(TransportationEnum::FLIGHT, '78A'),
                '45B',
                '344'
            ),
            'From Nice airport, take flight 78A to Paris airport. Gate 45B, seat 45B. Baggage drop at ticket counter 344.'
        ],
        'taxi' => [
            new BoardingCard(
                new Location('Nice airport', 'Nice', 'France', '45B'),
                new Location('Paris airport', 'Paris', 'France', type: LocationTypeEnum::AIRPORT),
                new Transportation(TransportationEnum::TAXI, 'taxi'),
            ),
            'Take the taxi from Nice airport to Paris airport'
        ],
    ]);