<?php


use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Bigyohann\TestMatawan\Model\Transportation;

test('can get all properties of object', function () {
    $location = new Location('Nice airport', 'Nice', 'France');
    expect($location->getName())->toBe('Nice airport')
        ->and($location->getCity())->toBe('Nice')
        ->and($location->getCountry())->toBe('France')
        ->and($location->getType())->toBeNull()
        ->and($location->getGate())->toBeNull();
});
