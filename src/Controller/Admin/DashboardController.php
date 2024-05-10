<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Configuration;
use App\Entity\Employee;
use App\Entity\Message;
use App\Entity\OpeningHours;
use App\Entity\Service;
use App\Entity\UsedCar;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CommentCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V. Parrot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-map-marker-alt', Comment::class);
        yield MenuItem::linkToCrud('Configuration', 'fas fa-map-marker-alt', Configuration::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Employees', 'fas fa-map-marker-alt', Employee::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Messages', 'fas fa-map-marker-alt', Message::class);
        yield MenuItem::linkToCrud('Horaires d\'ouverture', 'fas fa-map-marker-alt', OpeningHours::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Services', 'fas fa-map-marker-alt', Service::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Voitures d\'occasions', 'fas fa-map-marker-alt', UsedCar::class);
    }
}
