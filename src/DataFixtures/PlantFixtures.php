<?php

namespace App\DataFixtures;

use App\Entity\Plant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PlantFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $cucumber = new Plant();
        $cucumber->setName('Cucumber');
        $cucumber->setImg('https://www.thompson-morgan.com/product_images/100/8819865419806.jpg');
        $cucumber->setPrice_buy(20);
        $cucumber->setPrice_sell(80);
        $cucumber->setTime(30); //in seconds

        $tomato = new Plant();
        $tomato->setName('Tomato');
        $tomato->setImg('https://cdn.pixabay.com/photo/2014/04/02/14/04/tomato-306083_960_720.png');
        $tomato->setPrice_buy(30);
        $tomato->setPrice_sell(100);
        $tomato->setTime(50);
        

        $manager->persist($cucumber);
        $manager->persist($tomato);

        $manager->flush();

        $this->addReference('plant-cucumber', $cucumber);
        $this->addReference('plant-tomato', $tomato);
    }
}