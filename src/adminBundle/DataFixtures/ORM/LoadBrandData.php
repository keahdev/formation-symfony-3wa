<?php

namespace AppBundle\DataFixtures\ORM;

use adminBundle\Entity\Brand;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface

    //OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $brand = new Brand();
        $brand->setTitre('titre 2');

        $manager->persist($brand);
        $manager->flush();
        // création d'une variable afin de pouvoir relier un produit à une id brand existante
        $this->addReference('nouvelle-marque', $brand);
    }

    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 2;
    }

}