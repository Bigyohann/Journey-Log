<?php

namespace Bigyohann\TestMatawan\Services;

interface JourneySorterInterface
{
    public function sort(array $boardingCards): array;
}