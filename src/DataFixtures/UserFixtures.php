<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@email.com');
        $user->setPlainPassword('user');
        $user->addRole('ROLE_USER');
        $user->setEnabled(true);
        $user->setMoney(100);
        $user->setWater(5);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@email.com');
        $admin->setPlainPassword('admin');
        $admin->addRole('ROLE_ADMIN');
        $admin->setEnabled(true);
        $admin->setMoney(0);
        $admin->setWater(0);

        $manager->persist($user);
        $manager->persist($admin);

        $manager->flush();

        $this->addReference('user-user1', $user);
    }

}