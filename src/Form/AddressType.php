<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('alias', TextType::class, ['label' => 'Nom de l\'adresse']);
        $builder->add('address', TextType::class, ['label' => 'Adresse']);
        $builder->add('address2', TextType::class, ['label' => 'Adresse 2', 'required' => false]);
        $builder->add('zipCode', TextType::class, ['label' => 'Code postal']);
        $builder->add('city', TextType::class, ['label' => 'Ville']);
        $builder->add('country', CountryType::class, ['label' => 'Pays']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
