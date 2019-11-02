<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'Titre',
        ]);
        $builder->add('reference', TextType::class, [
            'label' => 'Réference',
        ]);
        $builder->add('description', TextareaType::class, [
            'label' => 'Description',
        ]);
        $builder->add('priceEt', MoneyType::class, [
            'currency' => 'EUR',
            'label'    => 'Prix HT',
        ]);
        $builder->add('priceIt', MoneyType::class, [
            'currency' => 'EUR',
            'label'    => 'Prix TTC',
            'attr'  => [
                'class' => 'disabled'
            ],
        ]);
        $builder->add('taxRule', ChoiceType::class, [
            'choices' => [
                'Taux standard (20%)' => 20
            ],
            'label'   => 'TVA',
        ]);
        $builder->add('add', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr'  => [
                'class' => 'btn-success'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
