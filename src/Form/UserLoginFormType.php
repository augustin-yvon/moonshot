<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserLoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'email ne peut pas être vide.',
                    ]),
                    new Assert\Email([
                        'message' => 'L\'email {{ value }} n\'est pas un email valide.',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le mot de passe ne peut pas être vide.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Pas de data_class ici car ce n'est pas un formulaire lié à une entité
            'data_class' => null,
        ]);
    }
}