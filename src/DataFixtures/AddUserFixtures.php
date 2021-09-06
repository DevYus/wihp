<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class AddUserFixtures
 * @package App\DataFixtures
 */
class AddUserFixtures extends Fixture
{
    private $passwordHasher;

    /**
     * AppFixtures constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Add a default Super Admin User
        $user = new User();

        // Fill user fields
        $user
            ->setLastname('John')
            ->setFirstname('Doe')
            ->setPassword($this->passwordHasher->hashPassword($user, '123456'))
            ->setEmail('johndoe@toto.com')
            ->setLogin('admin')
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setStatus('valide')
        ;

        //Persist and flush + use symfony console doctrine:fixtures:load to insert in DB
        $manager->persist($user);
        $manager->flush();
    }
}
