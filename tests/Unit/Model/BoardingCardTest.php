<?php


use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Bigyohann\TestMatawan\Model\Transportation;

test('can get all properties of object', function () {
    $source = new Location('Nice airport', 'Nice', 'France');
    $destination = new Location('Paris airport', 'Paris', 'France');
    $boardingCard = new BoardingCard(
        $source,
        $destination,
        new Transportation(TransportationEnum::FLIGHT, '78A'),
        '45B',
        '344'
    );

    expect($boardingCard->getSource())->toBe($source)
        ->and($boardingCard->getDestination())->toBe($destination)
        ->and($boardingCard->getTransportation()->getType())->toBe(TransportationEnum::FLIGHT)
        ->and($boardingCard->getTransportation()->getName())->toBe('78A')
        ->and($boardingCard->getSeatAssignment())->toBe('45B')
        ->and($boardingCard->getBaggageDrop())->toBe('344');
});
