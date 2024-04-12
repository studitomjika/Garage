<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/homepage', name: 'home')]
    public function index(): Response
    {
        /* return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]); */

        return new Response(<<<EOF
            <html>
                <body>
                    <h1>coucou!</h1>
                        <p>couroucoucou</p>
                </body>
            </html>
            EOF
        );
    }
}
