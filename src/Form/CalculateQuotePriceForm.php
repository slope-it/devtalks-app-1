<?php
declare(strict_types=1);

namespace App\Form;

use App\Command\CalculateQuotePrice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculateQuotePriceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'arrivalDate',
            DateType::class,
            [
                'label' => 'arrival_date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'input_format' => 'yyyy-MM-dd',
            ]
        )->add(
            'nightsCount',
            IntegerType::class,
            [
                'label' => 'nights_count',
            ]
        )->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'calculate',
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculateQuotePrice::class,
        ]);
    }
}
