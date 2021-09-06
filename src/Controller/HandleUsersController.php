<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\HandleUsersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class HandleUsersController
 * @package App\Controller
 */
class HandleUsersController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     * @Route("/handle/users", name="handle_users")
     */
    public function createUser(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        // Creation and handle the UsersType that we created
        $form = $this->createForm(HandleUsersType::class, $user);
        $form->handleRequest($request);

        // Verify the form
        if($form->isSubmitted() && $form->isValid()) {

            //Symfony take data automatically, we have only to crypt password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            // Persist and insert in BDD
            $em->persist($user);
            $em->flush();

            // Notice if all is well
            $this->addFlash('notice','L\'utilisateur a bien été crée');

            return $this->redirectToRoute('users_list');
        }

        return $this->render('handle_users/handle_users.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/handle/users/{id<\d+>}", name="handle_users_edit")
     */
    public function editUser(Request $request,User $user, EntityManagerInterface $em): Response
    {
        // Creation and handle the UsersType that we created
        $form = $this->createForm(HandleUsersType::class, $user);
        $form->handleRequest($request);

        // Verify the form
        if($form->isSubmitted() && $form->isValid()) {

            // Persist and insert in BDD
            $em->persist($user);
            $em->flush();

            // Notice if all is well
            $this->addFlash('notice','L\'utilisateur a bien été édité');

            //return $this->redirectToRoute( '', ['id' => $user->getId()]);
            return $this->redirectToRoute('users_list');
        }

        return $this->render('handle_users/handle_users.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
