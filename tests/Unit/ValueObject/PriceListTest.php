<?php
declare(strict_types=1);

namespace App\Tests\Unit\ValueObject;

use App\ValueObject\PriceList;
use PHPUnit\Framework\TestCase;

class PriceListTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_the_price_for_an_undefined_season()
    {
        // Set up test data
        $SUT = new PriceList(
            new \DateTime('2021-01-01'),
            new \DateTime('2021-12-31'),
            50,
            new \DateTime('2020-01-01'),
            new \DateTime('2020-12-31'),
            30,
            100
        );

        $arrivalDate = new \DateTime('2022-09-01');

        // Action
        $price = $SUT->getPricePerNight($arrivalDate);

        // Expectation
        $this->assertEquals(100, $price);
    }

    /**
     * @test
     */
    public function it_returns_the_price_for_high_season()
    {
        // Set up test data
        $SUT = new PriceList(
            new \DateTime('2021-01-01'),
            new \DateTime('2021-12-31'),
            50,
            new \DateTime('2020-01-01'),
            new \DateTime('2020-12-31'),
            30,
            100
        );

        $arrivalDate = new \DateTime('2021-01-01');

        // Action
        $price = $SUT->getPricePerNight($arrivalDate);

        // Expectation
        $this->assertEquals(50, $price);
    }

    /**
     * @test
     */
    public function it_returns_the_price_for_low_season()
    {
        // Set up test data
        $SUT = new PriceList(
            new \DateTime('2021-01-01'),
            new \DateTime('2021-12-31'),
            50,
            new \DateTime('2020-01-01'),
            new \DateTime('2020-12-31'),
            30,
            100
        );

        $arrivalDate = new \DateTime('2020-12-31');

        // Action
        $price = $SUT->getPricePerNight($arrivalDate);

        // Expectation
        $this->assertEquals(30, $price);
    }
}
