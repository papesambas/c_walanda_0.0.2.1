<?php

namespace App\DataFixtures;

use App\Entity\Ninas;
use App\Entity\Noms;
use Faker;
use Faker\Factory;
use App\Entity\Peres;
use App\Entity\Prenoms;
use App\Entity\Professions;
use App\Entity\Telephones1;
use App\Entity\Telephones2;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PeresFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $usedPhoneNumbers = [];
        $usedPhoneNumbers1 = [];
        $usedNina = [];


        for ($i = 1; $i <= 100; $i++) {
            $profession = $this->getReference('profession_' . $faker->numberBetween(1, 250),Professions::class);
            $pere = new Peres();

            do {
                $telephone1 = $this->getReference('telephone_' . $faker->numberBetween(1, 150), Telephones1::class);
            } while (in_array($telephone1->getId(), $usedPhoneNumbers));

            do {
                $telephone2 = $this->getReference('telephone2_' . $faker->numberBetween(301, 450), Telephones2::class);
            } while (in_array($telephone2->getId(), $usedPhoneNumbers1));

            do {
                $nina = $this->getReference('nina_' . $faker->numberBetween(1, 150), Ninas::class);
            } while (in_array($nina->getId(), $usedNina));

            $usedPhoneNumbers[] = $telephone1->getId();
            $usedPhoneNumbers1[] = $telephone2->getId();
            $usedNina[] = $nina->getId();

            $nom = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
            $prenom = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
            
            $pere->setNom($nom);
            $pere->setPrenom($prenom);
            $pere->setProfession($profession);
            $pere->setTelephone1($telephone1);
            $pere->setTelephone2($telephone2);
            $pere->setNina($nina)
        ;

            $manager->persist($pere);
            $this->addReference('pere_' . $i, $pere);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LieuNaissancesFixtures::class,
        ];
    }
}