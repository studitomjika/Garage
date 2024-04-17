<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Votre nom',
                /*'required' => false,*/ /* activer pour tester la validation coté serveur */
                /* 'constraints' => [
                     new Assert\NotBlank([
                        'message' => 'Veuillez indiquer votre nom. (Type)'
                    ]), 
                    ] */ /* comment eviter le doublement de l'erreur ?*/
                ])
            ->add('message', null, [
                'label' => 'Votre commentaire',
                ])
            ->add('grade', ChoiceType::class, [
                'label' => 'Note',
                'choices' => [
                    1 => false,
                    2 => false,
                    3 => false,
                    4 => false,
                    5 => false,
                ],
                'expanded' => true,
                ])
            ->add('submit', SubmitType::class)

            /*->add('accepted')
            ->add('employee', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
