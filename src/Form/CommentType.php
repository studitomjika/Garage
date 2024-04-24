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
                'required' => true, /* false pour tester la validation coté serveur */
                ])
            ->add('message', null, [
                'label' => 'Votre commentaire',
                'required' => true, /* false pour tester la validation coté serveur */
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
                'required' => true, /* false pour tester la validation coté serveur */
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
