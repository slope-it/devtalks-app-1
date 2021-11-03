<?php
declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Component\Panther\PantherTestCase;

class QuoteTest extends PantherTestCase
{
    /**
     * @test
     */
    public function it_calculates_quote_price()
    {
        $client = static::createPantherClient();
        $client->request('GET', '/');

        $this->assertPageTitleSame('Richiedi preventivo');

        $this->assertSelectorIsVisible('[name="calculate_quote_price_form[arrivalDate]"]');

        $crawler = $client->getCrawler();
        $form = $crawler->selectButton('Calcola')->form();
        $form->setValues([
            'calculate_quote_price_form[arrivalDate]' => '17/11/2021',
            'calculate_quote_price_form[nightsCount]' => '2',
        ]);
        $client->submit($form);

        $this->assertPageTitleSame('Il tuo preventivo');
        $this->assertSelectorExists('h3[data-test="quote-amount"]');
    }
}
