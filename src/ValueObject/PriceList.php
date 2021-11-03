<?php
declare(strict_types=1);

namespace App\ValueObject;

class PriceList
{
    private float $fallbackPrice;

    private \DateTime $highSeasonEndDate;

    private float $highSeasonPrice;

    private \DateTime $highSeasonStartDate;

    private \DateTime $lowSeasonEndDate;

    private float $lowSeasonPrice;

    private \DateTime $lowSeasonStartDate;

    public function __construct(
        \DateTime $highSeasonStartDate,
        \DateTime $highSeasonEndDate,
        float $highSeasonPrice,
        \DateTime $lowSeasonStartDate,
        \DateTime $lowSeasonEndDate,
        float $lowSeasonPrice,
        float $fallbackPrice
    ) {
        $this->highSeasonStartDate = $highSeasonStartDate;
        $this->highSeasonEndDate = $highSeasonEndDate;
        $this->highSeasonPrice = $highSeasonPrice;

        $this->lowSeasonStartDate = $lowSeasonStartDate;
        $this->lowSeasonEndDate = $lowSeasonEndDate;
        $this->lowSeasonPrice = $lowSeasonPrice;

        $this->fallbackPrice = $fallbackPrice;
    }

    public function getPricePerNight(\DateTime $arrivalDate): float
    {

        if ($arrivalDate >= $this->highSeasonStartDate && $arrivalDate <= $this->highSeasonEndDate) {
            return $this->highSeasonPrice;
        }

        if ($arrivalDate >= $this->lowSeasonStartDate && $arrivalDate <= $this->lowSeasonEndDate) {
            return $this->lowSeasonPrice;
        }

        return $this->fallbackPrice;
    }
}
