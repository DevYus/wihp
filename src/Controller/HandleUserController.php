<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HandleUserController extends AbstractController
{
    /**
     * @Route("/handle/user", name="handle_user")
     */
    public function index(): Response
    {
        return $this->render('handle_user/index.html.twig', [
            'controller_name' => 'HandleUserController',
        ]);
    }
}
