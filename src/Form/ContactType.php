<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    ]
            ])
            ->add('email',EmailType::class,[
                'label' => 'Adresse email',
                'attr' => [
                    'class' => 'form-control',
                    'placehoder' => 'martin@martin.fr'
                ]

            ])
            ->add('subject', ChoiceType::class,
            [   'label' => 'Sujet',
                'choices' => [
                    '' => 'Choisissez un sujet',
                    'Question' => 'Question',
                    'Problème technique' => 'Problème technique',
                    'Améliorations' => 'Améliorations',
                    'Autres' => 'Autres',
                ]

            ])
            ->add('message',TextareaType::class,
            [
                'attr'=>[
                    'placeholder' =>'Entrez votre msg ici !'
                ]
            ])

            // ->add('message',CKEditorType::class,
            // [
            //     'config'=>[
            //         'uiColor' =>'#ffffff'
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
