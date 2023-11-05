<?php


use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Model\Transportation;

test('can get all properties of object', function () {
    $transportation = new Transportation(TransportationEnum::FLIGHT, '78A');
    expect($transportation->getType())->toBe(TransportationEnum::FLIGHT)
        ->and($transportation->getName())->toBe('78A');
});
