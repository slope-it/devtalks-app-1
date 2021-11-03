<?php
declare(strict_types=1);

namespace App\Command;

class CalculateQuotePrice
{
    public ?float $amount = null;

    public ?\DateTime $arrivalDate;

    public ?int $nightsCount = null;

    public function __construct()
    {
        $this->arrivalDate = new \DateTime();
    }
}
