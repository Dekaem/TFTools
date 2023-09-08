<?php

namespace App\Form;

use App\Entity\Champion;
use App\Entity\Objet;
use App\Entity\Origine;
use App\Repository\ItemRepository;
use App\Repository\ObjetRepository;
use App\Repository\OrigineRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChampionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('tier', ChoiceType::class, [
                'multiple' => false,
                'choices' => Champion::TIERS,
                'required' => true
            ])
            ->add('origines', EntityType::class, [
                'label' => 'Traits',
                'class' => Origine::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'required' => true,
                'query_builder' => function (OrigineRepository $origineRepository): QueryBuilder {
                    return $origineRepository->createQueryBuilder('o')
                        ->orderBy('o.nom', 'ASC');
                }
            ])
            ->add('stuff', EntityType::class, [
                'label' => 'Les meilleurs objets (3 <i class="fa-solid fa-cubes"></i>)',
                'label_html' => true,
                'class' => Objet::class,
                'multiple' => true,
                'choice_label' => 'nom',
                'required' => true,
                'query_builder' => function (ObjetRepository $objetRepository): QueryBuilder {
                    return $objetRepository->createQueryBuilder('obj')
                        ->orderBy('obj.nom', 'ASC');
                }
            ])
            ->add('valider', SubmitType::class, ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Champion::class,
        ]);
    }
}
