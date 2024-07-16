<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                    'label' => 'Prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom',
                    ]),
                    new Length([
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('lastname', TextType::class, [
                    'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom',
                    ]),
                    new Length([
                        'max' => 255,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                    'label' => 'Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse email',
                    ]),
                    new Length([
                        'max' => 255,
                    ]),
                ],
            ])
             
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre date de naissance',
                    ]),
                    new Range([
                        'min' => '01-01-1900',
                        'max' => 'today',
                        'notInRangeMessage' => 'La date doit être postérieure à {{ limit }} et antérieure ou égale à {{ max }}.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'JJ/MM/AAAA', 
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 255,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
