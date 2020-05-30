<?php

namespace App\DataFixtures;

use App\Domain\Core\Entity\Locale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocaleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $localeFr = (new Locale())
            ->setCode(Locale::CODE_FR)
            ->setName(Locale::NAME_FR);

        $localeEn = (new Locale())
            ->setCode(Locale::CODE_EN)
            ->setName(Locale::NAME_EN);

        $manager->persist($localeFr);
        $manager->persist($localeEn);

        $manager->flush();
    }
}
