<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use App\Validator\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
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
        $builder->add('birthday', BirthdayType::class, [
            'label'  => 'Date de naissance',
            'widget' => 'single_text'
        ]);
        $builder->add('phoneNumber', TelType::class, [
            'attr'        => ['max' => 10],
            'constraints' => new PhoneNumber(),
            'label'       => 'Mobile',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
