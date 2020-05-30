<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
use App\Service\User\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class UserFixture extends Fixture
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create('fr_FR');

        $user = (new User())
            ->setEmail('user@example.org')
            ->setUsername('username')
            ->setFirstName($faker->firstName)
            ->setLastName($faker->lastName)
            ->setPhoneNumber('06'.$faker->phoneNumber08)
            ->setBirthday($faker->dateTimeInInterval('-50 years', '-18 years'));

        $user = $this->userManager->setPassword($user, 'test');

        $homeAddress = (new Address())
            ->setAlias('Home')
            ->setAddress('55 Rue du Commerce')
            ->setCity('Paris')
            ->setZipCode('75001')
            ->setCountry('FR');

        $workAddress = (new Address())
            ->setAlias('Work')
            ->setAddress('119 Rue du la Paie')
            ->setCity('Paris')
            ->setZipCode('75003')
            ->setCountry('FR');

        $user->addAddress($homeAddress);
        $user->addAddress($workAddress);

        $manager->persist($user);
        $manager->flush();
    }
}
