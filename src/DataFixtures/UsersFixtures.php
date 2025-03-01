<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Noms;
use App\Entity\Users;
use App\Entity\Prenoms;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    private $counter = 1;
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');


        $superAdmin = new Users();
        $superAdmin->setNom('SIDIBE');
        $superAdmin->setPrenom('Pape Samba');
        $superAdmin->setEmail('superadmin@demo.fr');
        $superAdmin->setUsername('superadmin');
        $superAdmin->setPassword(
            $this->passwordEncoder->hashPassword($superAdmin, 'superadmin')
        );
        $superAdmin->setRoles(['ROLE_SUPERADMIN']);
        $manager->persist($superAdmin);
        $this->addReference('user-' . $this->counter, $superAdmin);
        $this->counter++;

        $admin = new Users();
        $admin->setNom('TRAORE');
        $admin->setPrenom('Mamadou');
        $admin->setEmail('admin@demo.fr');
        $admin->setUsername('admin');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin123')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference('user-' . $this->counter, $admin);
        $this->counter++;

        for ($i = 1; $i <= 10; $i++) {
            if ($i <= 4) {
                $user = new Users();
                $user->setNom( $faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_ENSEIGNANT']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            } elseif ($i > 4 && $i <= 5) {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_SURVEILLANT']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            } elseif ($i > 5 && $i <= 6) {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_SECRETAIRE']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            }  elseif ($i > 6 && $i <= 7) {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_SURVEILLANT']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            } elseif ($i > 7 && $i <= 8) {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_CAISSIER']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            } elseif ($i > 8 && $i <= 9) {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_FINANCE']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            } else {
                $user = new Users();
                $user->setNom($faker->lastName());
                $user->setPrenom($faker->firstName());
                $user->setEmail($faker->email);
                $user->setFullName($faker->lastName() . ' ' . $faker->firstNameMale());
                $user->setRoles(['ROLE_DIRECTION']);
                $user->setUsername('User' . ' ' . $this->counter);
                $user->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secret')
                );
                $manager->persist($user);
                $this->addReference('user-' . $this->counter, $user);
                $this->counter++;
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            NinasFixtures::class,
        ];
    }
}
