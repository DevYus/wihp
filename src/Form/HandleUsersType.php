<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * Class HandleUsersType
 * @package App\Form
 */
class HandleUsersType extends AbstractType
{
    private $requestStack;
    private $security;

    /**
     * HandleUsersType constructor.
     * @param RequestStack $requestStack
     * @param Security $security
     */
    public function __construct(RequestStack $requestStack, Security $security)
    {
        $this->requestStack = $requestStack;
        $this->security = $security;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Get the requestStack to get the request so the current route to hide user password
        // Indeed the password must be known only to the user who has registered
        $request = $this->requestStack->getCurrentRequest();
        $route = $request->attributes->get('_route');

        //Get role of the current user to custom the select role
        $userGranted = $this->security->getUser()->getRoles()[0];

        $builder
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'inputLoginForm'],
            ])
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'inputLoginForm'],
            ])
            ->add('password',PasswordType::class, [
                'attr' => ['class' => 'inputLoginForm'],
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'inputLoginForm'],
            ])
            ->add('login',TextType::class,  [
                'attr' => ['class' => 'inputLoginForm'],
            ]);

            if($userGranted == 'ROLE_SUPER_ADMIN') {

                $builder
                    ->add('roles', ChoiceType::class, [
                        'attr' => ['class' => 'selectLoginForm'],
                        'choices' => [
                            'Admin' => 'ROLE_ADMIN',
                            'Customer' => 'ROLE_CUSTOMER',
                        ],
                        'required' => false,
                        'multiple' => false,
                        'expanded' => false,
                    ])
                    ->add('status', ChoiceType::class, [
                        'attr' => ['class' => 'selectLoginForm'],
                        'choices' => [
                            'valide' => 'valide',
                            'desactive' => 'desactive',
                            'en attente' => 'en attente'
                        ],
                        'required' => false,
                        'multiple' => false,
                        'expanded' => false,
                    ]);

            } else if ($userGranted == 'ROLE_ADMIN') {

                $builder
                    ->add('roles', ChoiceType::class, [
                        'attr' => ['class' => 'selectLoginForm'],
                        'choices' => [
                            'Customer' => 'ROLE_CUSTOMER',
                        ],
                        'required' => false,
                        'multiple' => false,
                        'expanded' => false,
                    ])
                    ->add('status', ChoiceType::class, [
                        'attr' => ['class' => 'selectLoginForm'],
                        'choices' => [
                            'valide' => 'valide',
                            'desactive' => 'desactive',
                            'en attente' => 'en attente'
                        ],
                        'required' => false,
                        'multiple' => false,
                        'expanded' => false,
                    ]);
            }


        if($route == 'handle_users_edit') {
            $builder->remove('password');
        }

        // Array to String to display in the form
        $this->roleTransformer($builder, 'roles');

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    /**
     * @param $builder
     * @param $field
     */
    private function roleTransformer($builder, $field)
    {
        // We will transform our array to string to display role attribute in our form
        $builder->get($field)
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // Array to string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // or string to array
                    return [$rolesString];
                }
            ));
    }
}
