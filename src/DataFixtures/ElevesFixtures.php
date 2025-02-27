<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\Noms;
use App\Entity\Eleves;
use App\Entity\Classes;
use App\Entity\Parents;
use App\Entity\Prenoms;
use App\Entity\Statuts;
use App\Entity\Departements;
use App\Entity\LieuNaissances;
use App\Entity\EcoleProvenances;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\EcoleProvenancesFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ElevesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $statut=$statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
        for ($i = 1; $i <= 750; $i++) {
            $ecole = $this->getReference('ecole_' . $faker->numberBetween(1, 100), EcoleProvenances::class);
            if ($i <= 20) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);

                $classe = $this->getReference('classePS_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                

                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 20 && $i <= 40) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);

                $classe = $this->getReference('classePS_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statutPS_' . $faker->numberBetween(1, 3), Statuts::class);

                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);

                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 40 && $i <= 60) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);

                $classe = $this->getReference('classeMS_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statutMS_' . $faker->numberBetween(1, 3), Statuts::class);

                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);

                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 60 && $i <= 80) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classeMS_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statutMS_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 80 && $i <= 100) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe1ere_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 100 && $i <= 120) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe1ere_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 120 && $i <= 140) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe2eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 140 && $i <= 160) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe2eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                //$eleve->setNina($nina);
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 160 && $i <= 180) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe3eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 180 && $i <= 200) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe3eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                //$eleve->setNina($nina);
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 200 && $i <= 220) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe4eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 220 && $i <= 240) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe4eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);

                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 240 && $i <= 260) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe5eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);

                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 260 && $i <= 280) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe5eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 280 && $i <= 300) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe6eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 300 && $i <= 320) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe6eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 320 && $i <= 340) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe7eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 340 && $i <= 360) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe7eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 360 && $i <= 380) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe7eme_' . $faker->numberBetween(3, 3), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 3), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 380 && $i <= 400) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe8eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 400 && $i <= 420) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe8eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 420 && $i <= 440) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe8eme_' . $faker->numberBetween(3, 3), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 440 && $i <= 460) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe9eme_' . $faker->numberBetween(1, 1), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                
                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 460 && $i <= 480) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);
                $classe = $this->getReference('classe9eme_' . $faker->numberBetween(2, 2), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);
                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);
                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                

                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            } elseif ($i > 480 && $i <= 500) {
                $departement = $this->getReference('departement_' . $faker->numberBetween(1, 1), Departements::class);

                $classe = $this->getReference('classe9eme_' . $faker->numberBetween(3, 3), Classes::class);
                $lieu = $this->getReference('lieu_' . $faker->numberBetween(1, 100), LieuNaissances::class);
                $nom  = $this->getReference('nom_' . $faker->numberBetween(1, 50), Noms::class);
                $prenom  = $this->getReference('prenom_' . $faker->numberBetween(1, 100), Prenoms::class);
                //$user  = $this->getReference('user_' . $faker->numberBetween(1, 8));
                $statut = $this->getReference('statut_' . $faker->numberBetween(1, 9), Statuts::class);

                $parent = $this->getReference('parent_' . $faker->numberBetween(1, 80), Parents::class);


                $ecoleProvenance = $this->getReference('ecole_' . $faker->numberBetween(1, 20), EcoleProvenances::class);
                $eleve = new Eleves();
                $eleve->setDateNaissance($faker->dateTimeBetween('-17 years', '-7 years'));
                $eleve->setLieuNaissance($lieu);
                $eleve->setDepartement($departement);
                $eleve->setNom($nom);
                $eleve->setPrenom($prenom);
                $eleve->setSexe($faker->randomElement(['M', 'F']));
                $eleve->setNumExtrait($faker->randomNumber(9, true));
                $eleve->setDateExtrait(($faker->dateTimeBetween('-16 years', '-6 years')));
                $eleve->setClasse($classe);
                $eleve->setDateInscription($faker->dateTimeBetween('-12 years', '-5 months'));
                $eleve->setDateRecrutement($faker->dateTimeBetween('-12 years', '-5 years'));
                //$eleve->setUser($user);
                $eleve->setStatuts($statut);
                $eleve->setEcoleAnDernier($ecoleProvenance);
                
                $eleve->setIsAdmis($faker->randomElement([true, false]));
                $eleve->setIsActif($faker->randomElement([true, false]));
                $eleve->setEcoleRecrutement($ecole);
                $eleve->setParent($parent);
                

                $manager->persist($eleve);
                $this->addReference('eleve_' . $i, $eleve);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            Scolarites9emeFixtures::class,
        ];
    }
}
