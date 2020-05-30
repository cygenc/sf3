<?php

namespace App\DataFixtures;

use App\Domain\Core\Entity\Locale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocaleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $isCreated = false;

        if (!$manager->getRepository(Locale::class)->findOneByCode(Locale::CODE_FR)) {
            $localeFr = (new Locale())
                ->setCode(Locale::CODE_FR)
                ->setName(Locale::NAME_FR);

            $manager->persist($localeFr);
            $isCreated = true;
        }

        if (!$manager->getRepository(Locale::class)->findOneByCode(Locale::CODE_EN)) {
            $localeEn = (new Locale())
                ->setCode(Locale::CODE_EN)
                ->setName(Locale::NAME_EN);

            $manager->persist($localeEn);
            $isCreated = true;
        }

        if ($isCreated) {
            $manager->flush();
        }
    }
}
