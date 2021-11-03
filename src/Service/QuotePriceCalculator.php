<?php
declare(strict_types=1);

namespace App\Service;

class QuotePriceCalculator
{
    private PriceListFactory $priceListFactory;

    public function __construct(PriceListFactory $priceListFactory)
    {
        $this->priceListFactory = $priceListFactory;
    }

    public function calculate(\DateTime $arrivalDate, int $nightsCount): float
    {
        if ($nightsCount <= 0) {
            throw new \Exception();
        }

        $priceList = $this->priceListFactory->create();

        $pricePerNight = $priceList->getPricePerNight($arrivalDate);
        $discountPercentage = $this->getLongStayDiscountPercentage($nightsCount);

        return $pricePerNight * $nightsCount * (1 - $discountPercentage);
    }

    private function getLongStayDiscountPercentage(int $nightsCount): float
    {
        if ($nightsCount >= 7) {
            return 0.2;
        }

        return 0;
    }
}
