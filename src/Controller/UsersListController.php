<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class UsersListController extends AbstractController
{
    /**
     * @return Response
     * @Route("/users-list", name="users_list")
     */
    public function index(UserRepository $userRepository): Response
    {
        // Several method use find() doctrine method or use a custom method if advanced developments are planned

        $users = $userRepository->findBy([],['id' => 'DESC']);

        return $this->render('users_list/index.html.twig', [
            'users' => $users,
        ]);
    }




}
