<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateStatusUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


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

        // Two ways to build form, in Controller or see Form Directory
        // Here to build mini form to update status ( i prefer buildFormType)
        /*
        $form = $this->createForm(UpdateStatusUserType::class, $user);
        $form->handleRequest($request);

        //If the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Backup to database
            $em->persist($user);
            $em->flush();
        }*/

        return $this->render('users_list/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/update/ajax", name="update_ajax", methods={"POST"})
     */
    public function ajaxAction(UserRepository $userRepository,EntityManagerInterface $em,Request $request)
    {

        $updateStatus = $request->request->get('status');
        $idMember = $request->request->get('id');

        //$userRepository->updateStatusUser($updateStatus,$idMember);

        $userUpdate = $userRepository->findOneBy(['id' => $idMember]);
        $userUpdate->setStatus($updateStatus);

        $em->persist($userUpdate);
        $em->flush();
        return new JsonResponse($userUpdate);

    }


}
