<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gender', ChoiceType::class, [
            'label'    => 'Genre',
            'expanded' => true,
            'choices'  => [
                'Masculin' => 'male',
                'Féminin'  => 'female',
            ],
        ]);
        $builder->add('firstName', TextType::class, ['label' => 'Prénom']);
        $builder->add('lastName', TextType::class, ['label' => 'Nom']);
        $builder->add('email', EmailType::class, ['label' => 'Email']);
        $builder->add('username', TextType::class, ['label' => 'Identifiant']);
        $builder->add('password', PasswordType::class, ['label' => 'Mot de passe', 'required' => false]);
        $builder->add('address', TextType::class, ['label' => 'Adresse']);
        $builder->add('address2', TextType::class, ['label' => 'Adresse 2', 'required' => false]);
        $builder->add('zipCode', TextType::class, ['label' => 'Code postal']);
        $builder->add('city', TextType::class, ['label' => 'Ville']);
        $builder->add('country', CountryType::class, ['label' => 'Pays']);
        $builder->add('birthday', BirthdayType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text'
        ]);
        $builder->add('add', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr'  => [
                'class' => 'btn btn-success btn-block'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
