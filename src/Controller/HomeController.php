<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\ServiceRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\CommentRepository;
use App\Repository\UsedCarRepository;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/home', name: 'homepage')]
    public function index(Request $request,
                          ConfigurationRepository $configurationRepository,
                          ServiceRepository $serviceRepository,
                          OpeningHoursRepository $openingHoursRepository,
                          CommentRepository $commentRepository,
                          UsedCarRepository $usedCarRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        /*
         comment ne pas recharger toute la page mais afficher les erreurs ?
        elseif ($form->isSubmitted() && !$form->isValid())
        {
            return $this->redirectToRoute('admin');
        } */

        return $this->render('home/index_garage.html.twig', [
            'services' => $serviceRepository->findAll(),
            'configurations' => $configurationRepository->findAll(),
            'opening_hours' => $openingHoursRepository->findAll(),
            'comments' => $commentRepository->findAll(),
            'used_cars' => $usedCarRepository->findAll(),
            'comment_form' => $form,
        ]);
    }
}
