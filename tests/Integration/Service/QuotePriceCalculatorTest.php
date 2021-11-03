<?php
declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Service\PriceListFactory;
use App\Service\QuotePriceCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QuotePriceCalculatorTest extends KernelTestCase
{
    /**
     * @test
     */
    public function it_calculates_reservation_price()
    {
        // Set up test data
        $priceListFactory = $this->getContainer()->get(PriceListFactory::class);
        $SUT = new QuotePriceCalculator($priceListFactory);

        $arrivalDate = new \DateTime('2021-06-01'); // In the high season
        $nightsCount = 2;

        // Action
        $price = $SUT->calculate($arrivalDate, $nightsCount);

        // Expectations: 80€ * 2 nights * 1 (no discount)
        $this->assertEquals(80 * 2, $price);
    }
}
