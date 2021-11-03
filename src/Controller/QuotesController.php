<?php
declare(strict_types=1);

namespace App\Controller;

use App\Command\CalculateQuotePrice;
use App\Form\CalculateQuotePriceForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class QuotesController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/", name="index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        $command = new CalculateQuotePrice();
        $form = $this->createForm(CalculateQuotePriceForm::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($command);
            return $this->render(
                'calculatedAmount.html.twig',
                [
                    'amount' => $command->amount,
                    'nights_count' => $command->nightsCount,
                    'arrival_date' => $command->arrivalDate,
                    'guest_count' => $command->guestCount,
                ]
            );
        }

        return $this->render(
            'index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
