<?php

namespace Bigyohann\TestMatawan\Formatter;

use Bigyohann\TestMatawan\Enums\LocationTypeEnum;
use Bigyohann\TestMatawan\Enums\TransportationEnum;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Exception;

class BoardingCardFormatter
{

    /**
     * @throws Exception
     */
    public function __invoke(BoardingCard $object): string
    {
        return $this->format($object);
    }

    /**
     * @throws Exception
     */
    public function format(BoardingCard $object): string
    {
        return match ($object->getTransportation()->getType()) {
            TransportationEnum::BUS => $this->handleBus($object),
            TransportationEnum::TRAIN => $this->handleTrain($object),
            TransportationEnum::FLIGHT => $this->handleFlight($object),
            TransportationEnum::TAXI => $this->handleTaxi($object),
            default => throw new Exception('Unknown transportation type')
        };
    }

    private function handleTrain(BoardingCard $object): string
    {
        return sprintf(
            'Take train %s from %s to %s. %s',
            $object->getTransportation()->getName(),
            $object->getSource()->getName(),
            $object->getDestination()->getName(),
            $object->getSeatAssignment() ? sprintf('Sit in seat %s.', $object->getSeatAssignment()) : 'No seat assignment.'
        );
    }

    private function handleBus(BoardingCard $object): string
    {
        $destinationType = $object->getDestination()->getType();
        match ($destinationType) {
            LocationTypeEnum::AIRPORT => $destinationType = 'airport',
            LocationTypeEnum::BUS_STATION => $destinationType = '',
            LocationTypeEnum::TRAIN_STATION => $destinationType = 'train station',
            default => ''
        };
        return sprintf(
            'Take the %s bus from %s to %s. %s',
            $destinationType,
            $object->getSource()->getName(),
            $object->getDestination()->getName(),
            $object->getSeatAssignment() ? sprintf('Sit in seat %s.', $object->getSeatAssignment()) : 'No seat assignment.'
        );
    }

    private function handleFlight(BoardingCard $object): string
    {
        $baggageDrop = $object->getBaggageDrop() ?

            sprintf('Baggage drop at ticket counter %s.', $object->getBaggageDrop()) :
            'Baggage will be automatically transferred from your last leg.';
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s. %s',
            $object->getSource()->getName(),
            $object->getTransportation()->getName(),
            $object->getDestination()->getName(),
            $object->getSource()->getGate(),
            $object->getSeatAssignment(),
            $baggageDrop
        );
    }

    private function handleTaxi(BoardingCard $object)
    {
        return sprintf(
            'Take the taxi from %s to %s',
            $object->getSource()->getName(),
            $object->getDestination()->getName()
        );
    }
}