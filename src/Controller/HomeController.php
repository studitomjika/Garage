<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\ServiceRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\CommentRepository;
use App\Repository\UsedCarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    //public function index(): Response
    public function index(ConfigurationRepository $configurationRepository,
                          ServiceRepository $serviceRepository,
                          OpeningHoursRepository $openingHoursRepository,
                          CommentRepository $commentRepository,
                          UsedCarRepository $usedCarRepository): Response
    {
        return $this->render('home/index_garage.html.twig', [
            'services' => $serviceRepository->findAll(),
            'configurations' => $configurationRepository->findAll(),
            'opening_hours' => $openingHoursRepository->findAll(),
            'comments' => $commentRepository->findAll(),
            'used_cars' => $usedCarRepository->findAll(),
        ]);
    }
}
