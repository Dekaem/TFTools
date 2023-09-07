<?php

namespace App\Form;

use App\Entity\Champion;
use App\Entity\Composition;
use App\Entity\Legende;
use App\Entity\Ville;
use App\Repository\ChampionRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('placeMoyenne', ChoiceType::class, [
                'label' => 'Place moyenne <i class="fa-solid fa-ranking-star"></i>',
                'label_html' => true,
                'multiple' => false,
                'choices' => Composition::PLACEMOYENNE,
                'required' => true
            ])
            ->add('champions', EntityType::class, [
                'label' => 'Champions (9 <i class="fa-solid fa-street-view"></i>)',
                'label_html' => true,
                'by_reference' => false,
                'class' => Champion::class,
                'multiple' => true,
                'choice_label' => function (Champion $champion) {
                     return 'Tier ' . $champion->getTier() . ' - ' . $champion->getNom();
                },
                'required' => false,
                'query_builder' => function (ChampionRepository $championRepository): QueryBuilder {
                    return $championRepository->createQueryBuilder('c')
                        ->orderBy('c.tier', 'ASC');
                },
            ])
            ->add('legende', EntityType::class, [
                'by_reference' => false,
                'class' => Legende::class,
                'multiple' => false
            ])
            ->add('valider', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Composition::class,
        ]);
    }
}
