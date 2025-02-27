<?php

namespace App\DataFixtures;

use App\Entity\Statuts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class StatutsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($st = 0; $st <= 12; $st++) {
            if ($st==1) {
                $statut = new Statuts();
                $statut->setDesignation("1ère Inscriptionn");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==2) {
                $statut = new Statuts();
                $statut->setDesignation("Transfert arrivé");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==3) {
                $statut = new Statuts();
                $statut->setDesignation("Passant");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==4) {
                $statut = new Statuts();
                $statut->setDesignation("Redoublant");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==5) {
                $statut = new Statuts();
                $statut->setDesignation("Transfert départ");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==6) {
                $statut = new Statuts();
                $statut->setDesignation("Abandon");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==7) {
                $statut = new Statuts();
                $statut->setDesignation("Exclus");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==8) {
                $statut = new Statuts();
                $statut->setDesignation("En attente");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==9) {
                $statut = new Statuts();
                $statut->setDesignation("Candidat libre");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==10) {
                $statut = new Statuts();
                $statut->setDesignation("Sans dossier");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }elseif ($st==11) {
                $statut = new Statuts();
                $statut->setDesignation("Passe au D.E.F");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }/*elseif ($st==12) {
                $statut = new Statuts();
                $statut->setDesignation("Passe au BAC");
                $manager->persist($statut);
                $this->setReference('statut_' . $st, $statut);
            }*/
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EtablissementsFixtures::class,

        ];
    }

}
