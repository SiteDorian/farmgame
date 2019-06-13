<?php

namespace App\DataFixtures;

use App\Entity\Land;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LandFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $land1 = new Land();
        
        $land1->setUser($manager->merge($this->getReference('user-user1')));

        $manager->persist($land1);

        $manager->flush();

        $this->addReference('land-land1', $land1);
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}