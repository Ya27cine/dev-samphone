<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => false,
                'attr' => [
                         'placeholder' => 'Prenom'
              ]
            ])
            ->add('lastname', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('phone', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Pone'
                ]
            ])
            ->add('email', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Email'
                ]
            ])
            ->add('message', TextareaType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Message'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
