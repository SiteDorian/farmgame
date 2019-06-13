<?php

namespace App\DataFixtures;

use App\Entity\Land;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LandFixtures extends Fixture 
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $land1 = new Land();

        $manager->persist($land1);

        $manager->flush();

        $this->addReference('land-land1', $land1);
    }
}