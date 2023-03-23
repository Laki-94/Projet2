<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TvaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('prix',NumberType::class,
        [
            'label' => "PRIX",
             'required' => true,
            'attr' => array('class' => 'ma_classe') ,
            'constraints' => [
                new Range([
                    'min' => 0,
                    'max' => 500,
                    'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
                ])
            ]
                ])
            ->add('calcul',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
