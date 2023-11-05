<?php

namespace Bigyohann\TestMatawan\Services;

use Bigyohann\TestMatawan\Exceptions\NoDestinationExistException;
use Bigyohann\TestMatawan\Formatter\BoardingCardFormatter;
use Bigyohann\TestMatawan\Model\BoardingCard;
use Bigyohann\TestMatawan\Model\Location;
use Exception;

class JourneySorter implements JourneySorterInterface
{

    private array $sortedCards;

    /**
     * @param BoardingCard[] $boardingCards
     * @throws NoDestinationExistException
     */
    public function __construct(array $boardingCards)
    {
        $this->sort($boardingCards);
    }

    /**
     * @throws NoDestinationExistException
     */
    public function sort(array $boardingCards): array
    {
        $sources = [];
        $destinations = [];
        foreach ($boardingCards as $card) {
            $sources[] = $card->getSource();
            $destinations[] = $card->getDestination();
        }

        $startPoint = array_keys(array_udiff($sources, $destinations, function (Location $source, Location $destination) {
            return ($source->getName() <=> $destination->getName()) . ($source->getCity() <=> $destination->getCity());
        }));
        $sortedCards = [];
        // There should be only one start point
        $currentPoint = $boardingCards[$startPoint[0]]->getSource();
        while (count($boardingCards) > 0) {
            $handled= false;
            foreach ($boardingCards as $key => $card) {
                if (
                    $card->getSource()->getCity() === $currentPoint->getCity()
                    &&
                    $card->getSource()->getName() === $currentPoint->getName()
                ) {

                    $sortedCards[] = $card;
                    $currentPoint = $card->getDestination();
                    unset($boardingCards[$key]);
                    $handled = true;
                    break;
                }
            }


            if (!$handled){
                throw new NoDestinationExistException();
            }
        }

        $this->sortedCards = $sortedCards;
        return $this->sortedCards;
    }

    /**
     * @throws Exception
     */
    public function generateJourneyLog(): array
    {
        $lines = [];
        $formatter = new BoardingCardFormatter();
        foreach ($this->sortedCards as $boardingCard) {
            $lines[] = $formatter($boardingCard);
        }
        $lines[] = "You have arrived at your final destination.";
        return $lines;
    }

    /**
     * @return BoardingCard[]
     */
    public function getSortedBoardingCards(): array
    {
        return $this->sortedCards;
    }
}