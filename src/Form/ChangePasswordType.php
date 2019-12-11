<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('currentPassword', PasswordType::class, [
            'constraints' => new UserPassword(['message' => 'Mot de passe actuel incorrect.']),
            'label'       => 'Mot de passe actuel',
            'mapped'      => false,
        ]);
        $builder->add('newPassword', RepeatedType::class, [
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
            'first_options'   => ['label' => 'Nouveau mot de passe'],
            'second_options'  => ['label' => 'Confirmation'],
            'type'            => PasswordType::class,
        ]);
    }
}
