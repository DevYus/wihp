<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class HomePrivateController
 * @package App\Controller
 */
class HomePrivateController extends AbstractController
{
    /**
     * @param Security $security
     * @return Response
     * @Route("/home", name="home_private")
     */
    public function index(Security $security): Response
    {
        // Display variable for private page hello
        $currentUser = $security->getUser();
        $lastname = $currentUser->getlastName();
        $firstname = $currentUser->getfirstName();

        return $this->render('home_private/index.html.twig', [
            'lastname' => $lastname,
            'firstname' => $firstname
        ]);
    }
}
