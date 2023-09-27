<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Controller\Admin\AuthorCrudController;
use App\Controller\Admin\EditorCrudController;
use App\Controller\Admin\FormatCrudController;
use App\Controller\Admin\CategoryCrudController;
use App\Controller\Admin\LanguageCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Book::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id');
        $title = TextField::new('title');
        $year = TextField::new('year')
        ->setFormTypeOptions([
            'attr' => [
                'maxlength' => 4
                // ,'disabled' => true
            ]
            ]);
        $isbn = TextField::new('isbn');
        $price = NumberField::new('price')
                    ->setNumDecimals(2);
        $pages = NumberField::new('pages');
        $desc = TextEditorField::new('description');
        $slug = SlugField::new('slug')
        ->setTargetFieldName('title')
        ->hideOnIndex();
        $cover = ImageField::new('cover', 'couverture du livre')
        ->setBasePath('uploads/images')
        ->setUploadDir('public/uploads/images')
        ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        $isAvail = BooleanField::new('isAvailable');
        // TODO: à voir avec les query builder
        // $author = AssociationField::new('authors')
        // ->autocomplete()
        // ->setCrudController(AuthorCrudController::class)
        // ;
        $category = AssociationField::new('category')
        ->setCrudController(CategoryCrudController::class)
        ;

        $format = AssociationField::new('format')
        ->setCrudController(FormatCrudController::class)
        ;

        $editeur = AssociationField::new('editor')
        ->setCrudController(EditorCrudController::class)
        ;

        $lang = AssociationField::new('language')
        ->setCrudController(LanguageCrudController::class)
        ;



        if (Crud::PAGE_EDIT === $pageName){
            return [
            // IdField::new('id')
            // ->onlyOnDetail(), //cache id sur le formulaire edit et add livre
            
            FormField::addPanel('Titre du livre')
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez le titre du livre"),
            $title,

            FormField::addPanel('Categorie')
            ->setIcon('fas fa-book')
            ->setHelp("CAT"),
            $category,

            FormField::addPanel('Format')
            ->setIcon('fas fa-book')
            ->setHelp("Format"),
            $format,

            FormField::addPanel('Editeur')
            ->setIcon('fas fa-book')
            ->setHelp("Editeur"),
            $editeur,

            FormField::addPanel('Langue')
            ->setIcon('fas fa-book')
            ->setHelp("Langue"),
            $lang,


            FormField::addPanel("Année de publication")
            ->setIcon('fas fa-calendar')
            ->setHelp("Quelle est l'année de publication du livre ?"),
            $year,

            // FormField::addPanel("Auteur")
            // ->setIcon('fas fa-hashtag')
            // ->setHelp("Qui est l'auteur du livre"),
            // $author,

            FormField::addPanel("N° ISBN")
            ->setIcon('fas fa-hashtag')
            ->setHelp("N° ISBN"),
            $isbn,

            FormField::addPanel("Entrez le prix de l'ouvrage")
            ->setIcon('fas fa-tag')
            ->setHelp("saisissez le prix !"),
            $price,

            FormField::addPanel("Nb de pages")
            ->setIcon('fas fa-file')
            ->setHelp("saisissez le nombre de pages !"),
            $pages,

            FormField::addPanel("Résumé de l'ouvrage")
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez un résumé du livre !"),
            $desc,

            FormField::addPanel("SLUG")
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez un Slug !"),
            $slug,

            FormField::addPanel("Couverture du livre")
            ->setIcon('fas fa-book')
            ->setHelp("saisissez la couverture !"),
            $cover,

            FormField::addPanel("Dispo ?")
            ->setIcon('fas fa-layer-group')
            ->setHelp("saisissez la dispo du livre !"),
            $isAvail,

            //TextEditorField::new('description'),
        ];
        } else{
            return [
            // IdField::new('id')
            // ->onlyOnDetail(), //cache id sur le formulaire edit et add livre
            
            FormField::addPanel('Titre du livre')
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez le titre du livre"),
            $title,
            
            FormField::addPanel('Categorie')
            ->setIcon('fas fa-book')
            ->setHelp("CAT"),
            $category,

            FormField::addPanel('Format')
            ->setIcon('fas fa-book')
            ->setHelp("Format"),
            $format,

            FormField::addPanel('Editeur')
            ->setIcon('fas fa-book')
            ->setHelp("Editeur"),
            $editeur,

            FormField::addPanel('Langue')
            ->setIcon('fas fa-book')
            ->setHelp("Langue"),
            $lang
            ->hideOnIndex(),

            FormField::addPanel("Année de publication")
            ->setIcon('fas fa-calendar')
            ->setHelp("Quelle est l'année de publication du livre ?"),
            $year,

            // FormField::addPanel("Auteur")
            // ->setIcon('fas fa-hashtag')
            // ->setHelp("Qui est l'auteur du livre"),
            // $author,

            FormField::addPanel("N° ISBN")
            ->setIcon('fas fa-hashtag')
            ->setHelp("N° ISBN"),
            $isbn
            ->hideOnIndex(),

            FormField::addPanel("Entrez le prix de l'ouvrage")
            ->setIcon('fas fa-tag')
            ->setHelp("saisissez le prix !"),
            $price
            ->hideOnIndex(),

            FormField::addPanel("Nb de pages")
            ->setIcon('fas fa-file')
            ->setHelp("saisissez le nombre de pages !"),
            $pages
            ->hideOnIndex(),

            FormField::addPanel("Résumé de l'ouvrage")
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez un résumé du livre !"),
            $desc,

            FormField::addPanel("SLUG")
            ->setIcon('fas fa-book')
            ->setHelp("Saisissez un Slug !"),
            $slug
            ->hideOnIndex(),

            FormField::addPanel("Couverture du livre")
            ->setIcon('fas fa-book')
            ->setHelp("saisissez la couverture !"),
            $cover,

            FormField::addPanel("Dispo ?")
            ->setIcon('fas fa-layer-group')
            ->setHelp("saisissez la dispo du livre !"),
            $isAvail,

            //TextEditorField::new('description'),
        ];
            
        }

        
    }
}
