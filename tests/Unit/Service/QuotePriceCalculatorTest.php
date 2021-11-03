<?php
declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\PriceListFactory;
use App\Service\QuotePriceCalculator;
use App\ValueObject\PriceList;
use PHPUnit\Framework\TestCase;

class QuotePriceCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function it_calculates_reservation_price()
    {
        // Set up test data
        $priceListFactory = $this->createMock(PriceListFactory::class);
        $SUT = new QuotePriceCalculator($priceListFactory);

        $priceList = new PriceList(
            new \DateTime('2021-01-01'),
            new \DateTime('2021-12-31'),
            80,
            new \DateTime('2020-01-01'),
            new \DateTime('2020-12-31'),
            30,
            100
        );

        $arrivalDate = new \DateTime('2021-06-01'); // In the high season
        $nightsCount = 2;
        $guestCount = 3;

        // Expectation: price per night will be got from a PriceList object
        $priceListFactory->method('create')->willReturn($priceList);

        // Action
        $price = $SUT->calculate($arrivalDate, $nightsCount, $guestCount);

        // Expectations: 80€ * 2 nights * 3 guests * 1 (no discount)
        $this->assertEquals(80 * 2 * 3, $price);
    }
}
