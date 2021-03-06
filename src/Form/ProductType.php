<?php

namespace App\Form;

use App\Domain\Product\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'Nom',
        ]);
        $builder->add('reference', TextType::class, [
            'label' => 'Réference',
        ]);
        $builder->add('description', TextareaType::class, [
            'label' => 'Description',
        ]);
        $builder->add('priceEt', MoneyType::class, [
            'currency' => 'EUR',
            'label' => 'Prix HT',
        ]);
        $builder->add('priceIt', MoneyType::class, [
            'attr' => [
                'readonly' => true,
            ],
            'currency' => 'EUR',
            'label' => 'Prix TTC',
        ]);
        $builder->add('taxRule', ChoiceType::class, [
            'attr' => [
                'readonly' => true,
            ],
            'choices' => [
                'Taux standard (20%)' => Product::TAX_RULE_STANDARD,
            ],
            'label' => 'TVA',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
