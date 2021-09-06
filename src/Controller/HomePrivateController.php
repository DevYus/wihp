<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomePrivateController extends AbstractController
{
    /**
     * @Route("/home", name="home_private")
     */
    public function index(Security $security): Response
    {
        $currentUser = $security->getUser();
        $lastname = $currentUser->getlastName();
        $firstname = $currentUser->getfirstName();

        return $this->render('home_private/index.html.twig', [
            'lastname' => $lastname,
            'firstname' => $firstname
        ]);
    }
}
