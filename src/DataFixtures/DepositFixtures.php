<?php

namespace App\DataFixtures;

use App\Entity\Deposit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DepositFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $deposit1 = new Deposit();
        $deposit1->setPlant($manager->merge($this->getReference('plant-tomato')));
        $deposit1->setUser($manager->merge($this->getReference('user-user1')));
        $deposit1->setCount(10);

        $deposit2 = new Deposit();
        $deposit2->setPlant($manager->merge($this->getReference('plant-cucumber')));
        $deposit2->setUser($manager->merge($this->getReference('user-user1')));
        $deposit2->setCount(0);

        $manager->persist($deposit1);
        $manager->persist($deposit2);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            PlantFixtures::class,
            UserFixtures::class,
        ];
    }
}