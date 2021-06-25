<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Album;
use App\Entity\Image;
use App\Entity\Comment;
use App\Entity\UserData;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\Admin\AlbumCrudController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(AlbumCrudController::class)->generateUrl());
//        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gallery');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'index', ['page' => 1]);
        yield MenuItem::linkToCrud('Album', 'fas fa-map-marker-alt', Album::class);
        yield MenuItem::linkToCrud('Image',  'fas fa-map-marker-alt', Image::class);
        yield MenuItem::linkToCrud('Comment', 'fas fa-map-marker-alt', Comment::class);
        yield MenuItem::linkToCrud('User profile', 'fas fa-map-marker-alt', UserData::class);
    }
}
