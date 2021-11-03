<?php
declare(strict_types=1);

namespace App\Service;

use App\ValueObject\PriceList;

class PriceListFactory
{
    public function create(): PriceList
    {
        $priceConfig = json_decode(file_get_contents(__DIR__ . '/../../files/price-config.json'), true);

        return new PriceList(
            new \DateTime($priceConfig['high_season']['start_date']),
            new \DateTime($priceConfig['high_season']['start_date']),
            $priceConfig['high_season']['price'],
            new \DateTime($priceConfig['low_season']['start_date']),
            new \DateTime($priceConfig['low_season']['start_date']),
            $priceConfig['low_season']['price'],
            $priceConfig['fallback_price']
        );
    }
}
