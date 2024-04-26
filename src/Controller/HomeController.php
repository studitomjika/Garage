<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\ServiceRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\CommentRepository;
use App\Repository\UsedCarRepository;
use App\Entity\Comment;
use App\Entity\Message;
use App\Form\CommentType;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\StreamedJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $form_comment = $this->createForm(CommentType::class, $comment);
        $form_comment->handleRequest($request);

        if ($form_comment->isSubmitted() && $form_comment->isValid()) {

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        /*
         comment ne pas recharger toute la page mais afficher les erreurs ?
        elseif ($form_comment->isSubmitted() && !$form_comment->isValid())
        {
            return $this->redirectToRoute('admin');
        } */

        $message = new Message();
        $form_contact = $this->createForm(ContactType::class, $message);
        $form_contact->handleRequest($request);

        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            $this->entityManager->persist($message);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        /*meilleur pratique */
        /* si sur cette route c'est une requete ajax (detect ajax php), retour en json, plus besoin de la route filter */
        /* if($request->isXmlHttpRequest())
        {
            exit(var_export("hello", 1));
            return filter($request, $usedCarRepository);
        } */

        return $this->render('home/index_garage.html.twig', [
            'services' => $serviceRepository->findAll(),
            'configurations' => $configurationRepository->findAll(),
            'opening_hours' => $openingHoursRepository->findAll(),
            'comments' => $commentRepository->findAll(),
            'used_cars' => $usedCarRepository->findByFilter(),
            'comment_form' => $form_comment,
            'contact_form' => $form_contact,
        ]);
    }

    /*#[Route('/filter', name: 'filter')]
    public function filter(Request $request, UsedCarRepository $usedCarRepository): Response
    {
        $used_cars = $usedCarRepository->findByFilter();

        $arrayResult = [];
        foreach($used_cars as $used_car)
        {//ne pas renvoyer les employe.e.s
            $arrayResult[] = [
                'id' => $used_car->getId(),
                'model' => $used_car->getModel(),
                'year' => $used_car->getYear(),
                'price' => $used_car->getPrice(),
                'picture_filename' => $used_car->getPictureFilename(),
            ];
        }
        
        $used_cars_json = json_encode($arrayResult);

        $response = new JsonResponse();
        $response->setData($used_cars_json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }*/

    #[Route('/filter2', name: 'filter2')]
    public function filter2(Request $request, UsedCarRepository $usedCarRepository, ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('home/filtered_cars.html.twig', [
            'used_cars' => $usedCarRepository->findByFilter(),
            'configurations' => $configurationRepository->findAll(),
        ]);
    }
}
