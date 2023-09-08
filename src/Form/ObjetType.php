<?php

namespace App\Form;

use App\Entity\Champion;
use App\Entity\Item;
use App\Entity\Objet;
use App\Entity\Origine;
use App\Repository\ChampionRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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
            ->add('embleme', CheckboxType::class, [
                'label' => "C'est un emblème",
                'required' => false
            ])
            ->add('recette',CheckboxType::class, [
                'mapped' => false,
                'label' => 'Pas de recette',
                'required' => false
            ])
            ->add('premierItem',EntityType::class, [
                'label' => 'Premier item',
                'class' => Item::class,
                'multiple' => false,
                'choice_label' => 'nom',
                'query_builder' => function (ItemRepository $itemRepository): QueryBuilder {
                    return $itemRepository->createQueryBuilder('i')
                        ->orderBy('i.nom', 'ASC');
                },
            ])
            ->add('secondItem',EntityType::class, [
                'label' => 'Second item',
                'class' => Item::class,
                'multiple' => false,
                'choice_label' => 'nom',
                'query_builder' => function (ItemRepository $itemRepository): QueryBuilder {
                    return $itemRepository->createQueryBuilder('i')
                        ->orderBy('i.nom', 'ASC');
                },
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
