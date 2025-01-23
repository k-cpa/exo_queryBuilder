<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'label' => 'Nom',
            ])
            ->add('race', ChoiceType::class, [
                'choices' => [
                    'Toutes les races' => null,
                    'Humain' => '1',
                    'Elf' => '2',
                    'Nain' => '3',
                    'Géant' => '4',
                    'Orc' => '5',
                    'Homme-poisson' => '6',
                    'Cosmocat' => '7',
                    'Mutant' => '8',
                ],
                'required' => false,
                'label' => 'Race',
            ])
            ->add('power_min', TextType::class, [
                'required' => false,
                'label' => 'Puissance minimale',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
