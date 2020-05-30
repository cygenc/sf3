<?php

namespace App\DataFixtures;

use App\Domain\Product\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create('fr_FR');

        for ($i = 0; $i < 100; ++$i) {
            $priceEt = $faker->randomFloat(2, 9, 1000);
            $priceIt = $priceEt * (1 + Product::TAX_RULE_STANDARD / 100);
            $product = (new Product())
                ->setName($faker->word)
                ->setReference(date('y').$faker->randomNumber(6, true))
                ->setDescription($faker->text)
                ->setPriceEt($priceEt)
                ->setPriceIt($priceIt)
                ->setTaxRule(Product::TAX_RULE_STANDARD);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
