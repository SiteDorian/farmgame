<?php

namespace App\DataFixtures;

use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CellFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $cell1 = new Cell();
        $cell1->setPlant($manager->merge($this->getReference('plant-tomato')));
        $cell1->setStage(5); //ready
        $cell1->setLand($manager->merge($this->getReference('land-land1')));

        $cell2 = new Cell();
        $cell2->setStage(0);
        $cell2->setLand($manager->merge($this->getReference('land-land1')));

        $cell3 = new Cell();
        $cell3->setStage(4);
        $cell3->setPlant($manager->merge($this->getReference('plant-cucumber')));
        $cell3->setLand($manager->merge($this->getReference('land-land1')));

        $cell4 = new Cell();
        $cell4->setStage(0);
        $cell4->setLand($manager->merge($this->getReference('land-land1')));

        $cell5 = new Cell();
        $cell5->setStage(0);
        $cell5->setLand($manager->merge($this->getReference('land-land1')));

        $manager->persist($cell1);
        $manager->persist($cell2);
        $manager->persist($cell3);
        $manager->persist($cell4);
        $manager->persist($cell5);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            PlantFixtures::class,
            LandFixtures::class,
        ];
    }
}