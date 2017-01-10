<?php

namespace AppBundle\DataFixtures\ORM;


use adminBundle\Entity\Categorie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCategoriesData extends AbstractFixture implements OrderedFixtureInterface

    //OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        $categorie = New Categorie();
         $categorie->setTitle('categorie 3')
             ->setDescription('description 3')
             ->setPosition(1)
             ->setActive(3);

        $manager->persist($categorie);
        $manager->flush();

    }

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 1;
    }
}