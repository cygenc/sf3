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

        $phoneNumber = str_replace('+33', '0', $faker->mobileNumber);
        $phoneNumber = str_replace(' ', '', $phoneNumber);

        $user = (new User())
            ->setEmail('user@example.org')
            ->setUsername('username')
            ->setFirstName($faker->firstName)
            ->setLastName($faker->lastName)
            ->setPhoneNumber($phoneNumber)
            ->setBirthday((new \DateTime())->modify('-30 years'));

        $user = $this->userManager->setPassword($user, 'test');

        $address = (new Address())
            ->setAlias('Maison')
            ->setAddress('55 Rue du Commerce')
            ->setCity('Paris')
            ->setZipCode('75001')
            ->setCountry('FR');

        $user->addAddress($address);

        $manager->persist($user);
        $manager->flush();
    }
}
