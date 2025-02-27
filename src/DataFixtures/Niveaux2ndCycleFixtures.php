<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Cycles;
use App\Entity\Niveaux;
use App\Entity\Statuts;
use App\Entity\Echeances;
use App\Entity\FraisType;
use App\Entity\FraisTypes;
use App\Entity\AnneeScolaires;
use App\Entity\FraisScolaires;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Niveaux2ndCycleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($niv = 1; $niv <= 3; $niv++) {
            if ($niv == 1) {
                $cycle = $this->getReference('cycle2nd_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('7ème Année');
                $niveau->setCycle($cycle);
                for ($i = 14; $i <= 20; $i++) {
                    if ($i == 14) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Inscription');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(13000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 15) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 16) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Inscription');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 17) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 18) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 18) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 19) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut7eme_' . $i, $statut);
                    } elseif ($i == 20) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->setReference('niveau7eme_' . $niv, $niveau);
            } elseif ($niv == 2) {
                $cycle = $this->getReference('cycle2nd_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('8ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 8; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut8eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->setReference('niveau8eme_' . $niv, $niveau);
            } else {
                $cycle = $this->getReference('cycle2nd_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('9ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 9; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 15; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 2) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Inscription');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);

                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
                                } elseif ($a == 3) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 5) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 6) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(1, 1), Echeances::class);
                                    $this->createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 7) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(2, 2), Echeances::class);
                                    $this->createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 8) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(3, 3), Echeances::class);
                                    $this->createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 9) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(4, 4), Echeances::class);
                                    $this->createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 10) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(5, 5), Echeances::class);
                                    $this->createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 11) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(6, 6), Echeances::class);
                                    $this->createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 12) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(7, 7), Echeances::class);
                                    $this->createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 13) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(8, 8), Echeances::class);
                                    $this->createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 14) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 15) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(9, 9), Echeances::class);
                                    $this->createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                    } elseif ($i == 9) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                        for ($j = 1; $j <= 1; $j++) {
                            $fraisType = new FraisTypes();
                            $fraisType->setPeriode('mensuel');
                            $fraisType->setNiveau($niveau);
                            $fraisType->setStatut($statut);
                            for ($a = 1; $a <= 1; $a++) {
                                $frais = new FraisScolaires();
                                if ($a == 1) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $this->createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                }
                            }
                            $manager->persist($fraisType);
                        }
                        $manager->persist($statut);
                        $this->addReference('statut9eme_' . $i, $statut);
                    }
                }
                $manager->persist($niveau);
                $this->setReference('niveau9eme_' . $niv, $niveau);
            }
        }
        $manager->flush();
    }


    private function createFraisScolairesInscription($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('Inscription');
        $frais->setEcheance($echeance);
        $frais->setMontant(5000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesInscriptionFree($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('Inscription');
        $frais->setEcheance($echeance);
        $frais->setMontant(5000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesCarnetFree($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('carnet');
        $frais->setEcheance($echeance);
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }
    private function createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('carnet');
        $frais->setEcheance($echeance);
        $frais->setMontant(1000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }
    private function createFraisScolairesTransfert($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('transfert');
        $frais->setEcheance($echeance);
        $frais->setMontant(10000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('septembre');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesOctobre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('octobre');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesNovembre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('novembre');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('décembre');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('janvier');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('février');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesMars($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('mars');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesAvril($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('avril');
        $frais->setEcheance($echeance);
        $frais->setMontant(15000);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesMai($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('mai');
        $frais->setEcheance($echeance);
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesJuin($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('juin');
        $frais->setEcheance($echeance);
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    private function createFraisScolairesArrieres($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('arriérés');
        $frais->setEcheance($echeance);
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }


    private function createFraisScolairesAutres($frais, $echeance, $anneeScolaire, $fraisType, $manager)
    {
        $frais->setDesignation('autres');
        $frais->setEcheance($echeance);
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
    }

    public function getDependencies(): array
    {
        return [
            Niveaux1erCycleFixtures::class,
        ];
    }
}
