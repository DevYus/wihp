<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UsersListController
 * @package App\Controller
 */
class UsersListController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/users-list", name="users_list")
     */
    public function index(Request $request, UserRepository $userRepository,EntityManagerInterface $em): Response
    {
        // Get User entity for formbuilder
        $user = new User;
        // Several ways : use find() doctrine method or use a custom method if advanced developments are planned
        $users = $userRepository->findBy([],['id' => 'DESC']);

        return $this->render('users_list/users_list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @param UserRepository $userRepository
     * @param Request $request
     * @return JsonResponse
     * @Route("/update/ajax", name="update_ajax", methods={"POST"})
     */
    public function ajaxAction(UserRepository $userRepository,Request $request)
    {
        // Update the user status with new post parameter, i choose native sql
        // for demonstration but we can also use querybuilder
        $updateStatus = $request->request->get('status');
        $idMember = $request->request->get('id');

        $userRepository->updateStatusUser($updateStatus,$idMember);

        return new JsonResponse('ok');

    }


}
