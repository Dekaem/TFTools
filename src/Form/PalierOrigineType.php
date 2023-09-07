<?php

namespace App\Form;

use App\Entity\Origine;
use App\Entity\Palier;
use App\Entity\PalierOrigine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PalierOrigineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('palier', EntityType::class, [
                'class' => Palier::class,
                'multiple' => false,
                'choice_label' => 'numero',
                'required' => true
            ])
            ->add('origine', EntityType::class, [
                'label' => 'Trait',
                'class' => Origine::class,
                'multiple' => false,
                'choice_label' => 'nom',
                'required' => true
            ])
            ->add('description')
            ->add('valider', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PalierOrigine::class,
        ]);
    }
}
