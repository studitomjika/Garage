<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\UsedCarRepository;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    //public function index(): Response
    public function index(Environment $twig, EmployeeRepository $employeeRepository): Response
    {
        /* return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]); */

        return new Response($twig->render('employee/index.html.twig', [
            'employees' => $employeeRepository->findAll(),
        ]));
    }

    #[Route('/employee/{id}', name: 'employee')]
    public function show(Environment $twig, Employee $employee, UsedCarRepository $usedCarsRepository): Response
    {
        return new Response($twig->render('employee/show.html.twig', [
            'employee' => $employee,
            'usedCars' => $usedCarsRepository->findBy(['employee' => $employee]),
        ]));
    }
}
