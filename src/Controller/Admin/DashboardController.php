<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Client;
use App\Entity\Editor;
use App\Entity\Format;
use App\Entity\Category;
use App\Entity\Language;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

     
        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bibliothèque');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Livres');
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Book::class);
        yield MenuItem::section('Autorités');
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-pen-nib', Author::class);
        yield MenuItem::linkToCrud('Editeurs', 'fas fa-users', Editor::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-user-circle', Client::class);
        yield MenuItem::section('Paramètres');
        yield MenuItem::linkToCrud('Categories', 'fas fa-building', Category::class);
        yield MenuItem::linkToCrud('Formats', 'fas fa-arrow-circle-down', Format::class);
        yield MenuItem::linkToCrud('Langues', 'fas fa-language', Language::class);
        yield MenuItem::section('Autres');
        yield MenuItem::linkToRoute('Retour au Site', 'fas fa-arrow-left', 'app_page');
    }
}
