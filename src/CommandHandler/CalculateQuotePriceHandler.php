<?php
declare(strict_types=1);

namespace App\CommandHandler;

use App\Command\CalculateQuotePrice;
use App\Service\QuotePriceCalculator;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CalculateQuotePriceHandler implements MessageHandlerInterface
{
    private QuotePriceCalculator $priceCalculator;

    public function __construct(QuotePriceCalculator $priceCalculator)
    {
        $this->priceCalculator = $priceCalculator;
    }

    public function __invoke(CalculateQuotePrice $command): void
    {
        $command->amount = $this->priceCalculator->calculate(
            $command->arrivalDate,
            $command->nightsCount,
            $command->guestCount
        );
    }
}
