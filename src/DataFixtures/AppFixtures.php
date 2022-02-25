<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Group;
use App\Entity\User;
use App\Entity\Ressource;
use App\Entity\Loan;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

public function __construct(UserPasswordHasherInterface $passwordHasher)
{
    $this->passwordHasher = $passwordHasher;
}

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setLabel('categorie' . $i);
            $manager->persist($category);

            $group = new Group();
            $group->setLabel('groupe' . $i);
            $manager->persist($group);

            
            $user = new User();
            $user->setFirstname('user'.$i);
            $user->setLastname('user'.$i);
            $user->setEmail('user'.$i.'@email.fr');
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'user'.$i
            ));
            //$user->setRoles(['user'.$i]);
            $manager->persist($user);

            
            $ressource = new Ressource();
            $ressource->setLabel('ressource'. $i);
            $ressource->setImage($i);
            $ressource->setDescription('ressource'. $i);
            $ressource->setQuantityTotal($i);
            $manager->persist($ressource);

            $loan = new Loan();
            $manager->persist($loan);
            
        }

        $manager->flush();
    }
}
