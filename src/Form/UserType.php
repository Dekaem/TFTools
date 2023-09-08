<?php

namespace App\Form;

use App\Entity\Composition;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            ->add('email')
            ->add('mdp', null, [
                'label' => 'Mot de passe',
                'mapped' => false
            ])
            ->add('choixRole', ChoiceType::class, [
                'mapped' => false,
                'label' => 'Rôle',
                'multiple' => false,
                'choices' => User::ROLES,
                'required' => true
            ])
            ->add('riotAccount', CheckboxType::class, [
                'label' => "Lier son compte Riot à TFTools",
                'required' => false
            ])
            ->add('valider', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
