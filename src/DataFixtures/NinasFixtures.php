<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\Ninas;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NinasFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $usedDesignations = []; // Stocke les désignations déjà générées

        for ($i = 1; $i <= 500; $i++) {
            $designation = null;

            // Générer une désignation unique
            do {
                $designation = $faker->bothify('############ ?');
            } while (in_array($designation, $usedDesignations));

            $usedDesignations[] = $designation; // Ajouter la désignation générée au tableau

            $nina = new Ninas();
            $nina->setDesignation($designation);

            $manager->persist($nina);
            $this->addReference('nina_' . $i, $nina);
        }

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            TelephonesFixtures::class,
        ];
    }
}
