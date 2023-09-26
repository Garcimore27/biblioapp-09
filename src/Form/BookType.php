<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Author;
use App\Entity\Editor;
use App\Entity\Format;
use App\Entity\Language;
use App\Repository\AuthorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titre du Livre',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('year', NumberType::class,[
                'label' => 'Année',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('isbn', TextType::class,[
                'label' => 'Isbn',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('price', MoneyType::class,[
                'label' => 'Prix',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('pages', NumberType::class,[
                'label' => 'Nb Pages',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Résumé',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('slug', TextType::class,[
                'label' => 'Slug',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('cover', TextType::class,[
                'label' => 'Cover',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('isAvailable', CheckboxType::class,[
                'label' => 'Disponibilité',
                'attr' =>['class' => 'form-check'],
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('authors', EntityType::class,[
                'class' => Author::class,
                'multiple' => true,
                'choice_label' => function (Author $author) {
                    return $author->getFirstname() . ' ' . $author->getLastname();},
                'label' => 'Auteurs',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('format', EntityType::class,[
                'class' => Format::class,
                'choice_label' => 'name',
                'label' => 'Format',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('editor', EntityType::class,[
                'class' => Editor::class,
                'choice_label' => 'name',
                'label' => 'Editeur',
                'attr' =>['class' => 'form-control'],
            ])
            ->add('language', EntityType::class,[
                'class' => Language::class,
                'choice_label' => 'name',
                'label' => 'Langue',
                'attr' =>['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
