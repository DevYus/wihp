<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\HandleUsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HandleUsersController extends AbstractController
{
    /**
     * @Route("/handle/users", name="handle_users")
     */
    public function index(): Response
    {
        $user = new User();

        $form = $this->createForm(HandleUsersType::class, $user);

        return $this->render('handle_users/handle_users.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
