<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('currentPassword', PasswordType::class, [
            'constraints' => new UserPassword(['message' => 'Mot de passe actuel incorrect.']),
            'label' => 'Mot de passe actuel',
            'mapped' => false,
        ]);
        $builder->add('newPassword', RepeatedType::class, [
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
            'first_options' => ['label' => 'Nouveau mot de passe'],
            'second_options' => ['label' => 'Confirmation'],
            'type' => PasswordType::class,
        ]);
    }
}
