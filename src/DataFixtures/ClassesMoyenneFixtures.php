<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Classes;
use App\Entity\Niveaux;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClassesMoyenneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($clM = 1; $clM <= 3; $clM++) {
            if ($clM == 1) {
                $niveau = $this->getReference('niveauMat_' . $faker->numberBetween(2, 2), Niveaux::class);
                $classe = new Classes();
                $classe->setDesignation('Moyenne Section 1');
                $classe->setCapacite('20');
                $classe->setNiveau($niveau);
                $manager->persist($classe);
                $this->setReference('classeMS_' . $clM, $classe);
            } elseif ($clM == 2) {
                $niveau = $this->getReference('niveauMat_' . $faker->numberBetween(2, 2), Niveaux::class);
                $classe = new Classes();
                $classe->setDesignation('Moyenne Section 2');
                $classe->setCapacite('20');
                $classe->setNiveau($niveau);
                $manager->persist($classe);
                $this->setReference('classeMS_' . $clM, $classe);
            } else {
                $niveau = $this->getReference('niveauMat_' . $faker->numberBetween(2, 2), Niveaux::class);
                $classe = new Classes();
                $classe->setDesignation('Moyenne Section 3');
                $classe->setCapacite('20');
                $classe->setNiveau($niveau);
                $manager->persist($classe);
                $this->setReference('classeMS_' . $clM, $classe);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ClassesPetiteFixtures::class,
        ];
    }
}
