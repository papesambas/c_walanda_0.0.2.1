<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Cycles;
use App\Entity\Etablissements;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Cycles2ndFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($cyc = 1; $cyc < 2; $cyc++) {
            if ($cyc == 1) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1),Etablissements::class);
                $cycle = new Cycles();
                $cycle->setDesignation('2nd Cycle');
                $cycle->setEtablissement($etablissement);
                $manager->persist($cycle);
                $this->setReference('cycle2nd_' . $cyc, $cycle);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            Cycles1erFixtures::class
        ];
    }}
