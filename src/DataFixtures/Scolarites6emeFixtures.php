<?php

namespace App\DataFixtures;

use App\Entity\Niveaux;
use Faker;
use App\Entity\Scolarites1;
use App\Entity\Scolarites2;
use App\Entity\Redoublements1;
use App\Entity\Redoublements2;
use App\Entity\Redoublements3;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Scolarites6emeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $niveau1ere = $this->getReference('niveau1er_' . $faker->numberBetween(1, 1), Niveaux::class);
        $niveau2eme = $this->getReference('niveau2eme_' . $faker->numberBetween(2, 2), Niveaux::class);
        $niveau3eme = $this->getReference('niveau3eme_' . $faker->numberBetween(3, 3), Niveaux::class);
        $niveau4eme = $this->getReference('niveau4eme_' . $faker->numberBetween(4, 4), Niveaux::class);
        $niveau5eme = $this->getReference('niveau5eme_' . $faker->numberBetween(5, 5), Niveaux::class);
        $niveau = $this->getReference('niveau6eme_' . $faker->numberBetween(6, 6), Niveaux::class);
        for ($s6eme = 1; $s6eme <= 4; $s6eme++) {
            if ($s6eme == 1) {
                $scolarites1 = new Scolarites1();
                $scolarites1->setScolarite(6);
                $scolarites1->setNiveau($niveau);
                for ($scol2nd = 1; $scol2nd <= 1; $scol2nd++) {
                    $scolarites2 = new Scolarites2();
                    $scolarites2->setNiveau($niveau);
                    $scolarites2->setScolarite(0);
                    $scolarites2->setScolarite1($scolarites1);
                    $manager->persist($scolarites2);
                }
                $manager->persist($scolarites1);
                $this->setReference('scolarite6eme_' . $s6eme, $scolarites1);
            } elseif ($s6eme == 2) {
                $scolarites1 = new Scolarites1();
                $scolarites1->setScolarite(7);
                $scolarites1->setNiveau($niveau);
                for ($scol2nd = 1; $scol2nd <= 1; $scol2nd++) {
                    $scolarites2 = new Scolarites2();
                    $scolarites2->setNiveau($niveau);
                    $scolarites2->setScolarite(0);
                    $scolarites2->setScolarite1($scolarites1);
                    for ($i = 1; $i <= 6; $i++) {
                        if ($i == 1) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau1ere);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        } elseif ($i == 2) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau2eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        } elseif ($i == 3) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau3eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        } elseif ($i == 4) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau4eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        } elseif ($i == 5) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau5eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        } elseif ($i == 6) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            $manager->persist($redoublement1);
                        }
                    }
                    $manager->persist($scolarites2);
                }
                $manager->persist($scolarites1);
                $this->setReference('scolarite6eme_' . $s6eme, $scolarites1);
            } elseif ($s6eme == 3) {
                $scolarites1 = new Scolarites1();
                $scolarites1->setScolarite(8);
                $scolarites1->setNiveau($niveau);
                for ($scol2nd = 1; $scol2nd <= 1; $scol2nd++) {
                    $scolarites2 = new Scolarites2();
                    $scolarites2->setNiveau($niveau);
                    $scolarites2->setScolarite(0);
                    $scolarites2->setScolarite1($scolarites1);
                    for ($i = 1; $i <= 6; $i++) {
                        if ($i == 1) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau1ere);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 5; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau2eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau3eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 4) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 5) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 2) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau2eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 4; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau3eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 4) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 3) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau3eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 3; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 4) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau4eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 2; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 5) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau5eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 1; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 6) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 1; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        }
                    }
                    $manager->persist($scolarites2);
                }
                $manager->persist($scolarites1);
                $this->setReference('scolarite6eme_' . $s6eme, $scolarites1);
            } elseif ($s6eme == 4) {
                $scolarites1 = new Scolarites1();
                $scolarites1->setScolarite(9);
                $scolarites1->setNiveau($niveau);
                for ($scol2nd = 1; $scol2nd <= 1; $scol2nd++) {
                    $scolarites2 = new Scolarites2();
                    $scolarites2->setNiveau($niveau);
                    $scolarites2->setScolarite(0);
                    $scolarites2->setScolarite1($scolarites1);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i == 1) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau1ere);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 5; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau2eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau3eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 4) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 5) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 2) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau2eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 4; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau3eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 4) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 3) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau3eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 3; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau4eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 3) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 4) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau4eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 2; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau5eme);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                } elseif ($a == 2) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        } elseif ($i == 5) {
                            $redoublement1 = new Redoublements1;
                            $redoublement1->setNiveau($niveau5eme);
                            $redoublement1->setScolarite1($scolarites1);
                            $redoublement1->setScolarite2($scolarites2);
                            for ($a = 1; $a <= 1; $a++) {
                                if ($a == 1) {
                                    $redoublement2 = new Redoublements2;
                                    $redoublement2->setNiveau($niveau);
                                    $redoublement2->setScolarite1($scolarites1);
                                    $redoublement2->setScolarite2($scolarites2);
                                    $redoublement2->setRedoublement1($redoublement1);
                                    $redoublement3 = new redoublements3();
                                    $redoublement3->setNiveau($niveau);
                                    $redoublement3->setScolarite1($scolarites1);
                                    $redoublement3->setScolarite2($scolarites2);
                                    $redoublement3->setRedoublement2($redoublement2);
                                    $manager->persist($redoublement3);
                                    $manager->persist($redoublement2);
                                }
                            }
                            $manager->persist($redoublement1);
                        }
                    }

                    $manager->persist($scolarites2);
                }
                $manager->persist($scolarites1);
                $this->setReference('scolarite6eme_' . $s6eme, $scolarites1);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            Scolarites5emeFixtures::class,

        ];
    }
}
