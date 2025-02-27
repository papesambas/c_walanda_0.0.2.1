<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Cycles;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\EnseignementsFixtures;
use App\Entity\Etablissements;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CyclesMatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($cyc = 1; $cyc < 2; $cyc++) {
            if ($cyc == 1) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1), Etablissements::class);
                $cycle = new Cycles();
                $cycle->setDesignation('Pré-Scolaire');
                $cycle->setEtablissement($etablissement);
                $manager->persist($cycle);
                $this->setReference('cyclemat_' . $cyc, $cycle);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EtablissementsFixtures::class
        ];
    }
}
