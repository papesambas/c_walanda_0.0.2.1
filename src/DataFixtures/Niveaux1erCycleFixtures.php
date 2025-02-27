<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaires;
use App\Entity\Cycles;
use App\Entity\Echeances;
use Faker;
use App\Entity\Niveaux;
use App\Entity\Statuts;
use App\Entity\FraisType;
use App\Entity\FraisScolaires;
use App\Entity\FraisTypes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Niveaux1erCycleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($niv = 1; $niv <= 6; $niv++) {
            if ($niv == 1) {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('1ère Année');
                $niveau->setCycle($cycle);
                for ($i = 6; $i <= 13; $i++) {
                    if ($i == 6) {
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 8) {
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 9) {

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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 10) {

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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 11) {

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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 12) {

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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                    } elseif ($i == 13) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau1er_' . $niv, $niveau);
            } elseif ($niv == 2) {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('2ème Année');
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut2eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau2eme_' . $niv, $niveau);
            } elseif ($niv == 3) {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('3ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 8; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $frais->addAnneeScolaire($anneeScolaire);
                        $frais->setFraisTypes($fraisType);
                        $manager->persist($statut);
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut3eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau3eme_' . $niv, $niveau);
            } elseif ($niv == 4) {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('4ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 8; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut4eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau4eme_' . $niv, $niveau);
            } elseif ($niv == 5) {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('5ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 8; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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

                        $frais->addAnneeScolaire($anneeScolaire);
                        $frais->setFraisTypes($fraisType);
                        $manager->persist($statut);
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut5eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau5eme_' . $niv, $niveau);
            } else {
                $cycle = $this->getReference('cycle1er_' . $faker->numberBetween(1, 1), Cycles::class);
                $anneeScolaire = $this->getReference('annee_1', AnneeScolaires::class);
                $niveau = new Niveaux();
                $niveau->setDesignation('6ème Année');
                $niveau->setCycle($cycle);
                for ($i = 1; $i <= 8; $i++) {
                    if ($i == 1) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 2) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 3) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 4) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 5) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 6) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $this->createFraisScolairesCarnet($frais, $echeance, $anneeScolaire, $fraisType, $manager);
                                } elseif ($a == 4) {
                                    $echeance = $this->getReference('mensuelle_' . $faker->numberBetween(0, 0), Echeances::class);
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(0);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 7) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
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
                                    $frais->setDesignation('Abandon');
                                    $frais->setEcheance($echeance);
                                    $frais->setMontant(5000);
                                    $frais->addAnneeScolaire($anneeScolaire);
                                    $frais->setFraisTypes($fraisType);
                                    $manager->persist($frais);
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
                        $frais->addAnneeScolaire($anneeScolaire);
                        $frais->setFraisTypes($fraisType);
                        $manager->persist($statut);
                        $this->addReference('statut6eme_' . $i, $statut);
                    } elseif ($i == 8) {

                        $statut =  $this->getReference('statut_' . $faker->numberBetween(1, 9),Statuts::class);
                        $niveau->addStatut($statut);
                    }
                }
                $manager->persist($niveau);
                $this->addReference('niveau6eme_' . $niv, $niveau);
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
        $frais->setMontant(0);
        $frais->addAnneeScolaire($anneeScolaire);
        $frais->setFraisTypes($fraisType);
        $manager->persist($frais);
}

private function createFraisScolairesSeptembre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
{
    $frais->setDesignation('septembre');
    $frais->setEcheance($echeance);
    $frais->setMontant(12000);
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
    $frais->setMontant(12000);
    $frais->addAnneeScolaire($anneeScolaire);
    $frais->setFraisTypes($fraisType);
    $manager->persist($frais);
}

private function createFraisScolairesDecembre($frais, $echeance, $anneeScolaire, $fraisType, $manager)
{
    $frais->setDesignation('décembre');
    $frais->setEcheance($echeance);
    $frais->setMontant(12000);
    $frais->addAnneeScolaire($anneeScolaire);
    $frais->setFraisTypes($fraisType);
    $manager->persist($frais);
}

private function createFraisScolairesJanvier($frais, $echeance, $anneeScolaire, $fraisType, $manager)
{
    $frais->setDesignation('janvier');
    $frais->setEcheance($echeance);
    $frais->setMontant(12000);
    $frais->addAnneeScolaire($anneeScolaire);
    $frais->setFraisTypes($fraisType);
    $manager->persist($frais);
}

private function createFraisScolairesFevrier($frais, $echeance, $anneeScolaire, $fraisType, $manager)
{
    $frais->setDesignation('février');
    $frais->setEcheance($echeance);
    $frais->setMontant(12000);
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
    $frais->setMontant(12000);
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
            NiveauxMaternelleFixtures::class,
        ];
    }
}
