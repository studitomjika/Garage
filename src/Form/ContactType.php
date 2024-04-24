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
                'label' => 'Votre nom',
                'required' => true, /* false pour tester la validation coté serveur */
                'constraints' => [
                    new Assert\NotBlank([
                    'message' => 'Veuillez indiquer votre nom.'
                    ]),]
                ])
            ->add('email', EmailType::class, [
                'label' => 'Votre mail',
                'required' => true, /* false pour tester la validation coté serveur */
                'constraints' => [
                    new Assert\NotBlank([
                    'message' => 'Veuillez indiquer un mail.'
                    ]),
                    new Assert\Email([
                    'message' => 'Veuillez indiquer un mail valide.'
                    ]),]
                ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Votre numéro de téléphone',
                'required' => true, /* false pour tester la validation coté serveur */
                'constraints' => [
                    new Assert\NotBlank([
                    'message' => 'Veuillez indiquer un numéro de téléphone.'
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/',
                        'match' => true,
                        'message' => 'Veuillez indiquer un numéro de téléphone valide.'
                    ]),]
                ])
            ->add('subject', null, [
                'label' => 'Sujet du message',
                'required' => true, /* false pour tester la validation coté serveur */
                'constraints' => [
                    new Assert\NotBlank([
                    'message' => 'Veuillez indiquer un sujet.'
                    ])] /* comment eviter le doublement de l'erreur ?*/
                ])
            ->add('message', null, [
                'label' => 'Votre message',
                'required' => true, /* false pour tester la validation coté serveur */
                'constraints' => [
                    new Assert\NotBlank([
                    'message' => 'Veuillez indiquer un messgae.'
                    ]),]
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
