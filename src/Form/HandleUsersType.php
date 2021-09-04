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

class HandleUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('password',PasswordType::class)
            ->add('email', TextType::class)
            ->add('login',TextType::class)
            ->add('roles',ChoiceType::class, [
                'choices' => [
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                    'Admin' => 'ROLE_ADMIN',
                    'Customer' => 'ROLE_CUSTOMER',
                ],
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('status',TextType::class)
        ;

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
        // We will transform our array to string to display your form
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