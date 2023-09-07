<?php

namespace App\Form;

use App\Entity\Champion;
use App\Entity\Item;
use App\Entity\Objet;
use App\Entity\Origine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('embleme', null, [
                'label' => 'Est-ce un emblème ?',
            ])
            ->add('recette',EntityType::class, [
                'label' => 'Recette',
                'class' => Item::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'required' => true
            ])
            ->add('valider', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
        ]);
    }
}
