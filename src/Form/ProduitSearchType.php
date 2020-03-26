<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\ProduitSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrix', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Buget Max'
                ]
            ])
            ->add('minQuantitie', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Quantitie Min'
                ]
            ])
            ->add('options', EntityType::class,[
                'required' => false,
                'label' => false,
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
         //   ->add('submit', SubmitType::class,[
         //       'label' => 'Rechercher'
         //   ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function  getBlockPrefix()
    {
        return '';
    }
}
