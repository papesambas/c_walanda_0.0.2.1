<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Cycles;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\EnseignementsFixtures;
use App\Entity\Etablissements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Cycles1erFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($cyc = 1; $cyc < 2; $cyc++) {
            if ($cyc == 1) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1),Etablissements::class);
                $cycle = new Cycles();
                $cycle->setDesignation('1er Cycle');
                $cycle->setEtablissement($etablissement);
                $manager->persist($cycle);
                $this->setReference('cycle1er_' . $cyc, $cycle);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CyclesMatFixtures::class
        ];
    }
}
