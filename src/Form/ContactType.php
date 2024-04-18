<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Votre nom',])
            ->add('email', EmailType::class, [
                'label' => 'Votre mail',])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Votre numéro de téléphone',])
            ->add('subject', null, [
                'label' => 'Sujet du message',
                'required' => false, /* activer pour tester la validation coté serveur */
                 'constraints' => [
                     new Assert\NotBlank([
                        'message' => 'Veuillez indiquer un sujet. (Type)'
                    ]),
                    ]  /* comment eviter le doublement de l'erreur ?*/
                ])
            ->add('message', null, [
                'label' => 'Votre message',
                ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
