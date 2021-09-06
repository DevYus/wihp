<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class UpdateStatusUserType
 * @package App\Form
 */
class UpdateStatusUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status',ChoiceType::class, [
                'label' => false,
                'attr' => ['class' => 'status'],
                'choices' => [
                    'Validé' => 'valide',
                    'En attente' => 'en attente',
                    'Désactivé' => 'desactive',
                ],
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('Valider', SubmitType::class)
        ;

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
}