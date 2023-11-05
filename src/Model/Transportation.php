<?php

namespace Bigyohann\TestMatawan\Model;

use Bigyohann\TestMatawan\Enums\TransportationEnum;

readonly class Transportation
{
    public function __construct(
        private TransportationEnum $type,
        private string $name,
    )
    {
    }

    public function getType(): TransportationEnum
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }


}