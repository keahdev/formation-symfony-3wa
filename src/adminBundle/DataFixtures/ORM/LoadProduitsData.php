<?php

namespace AppBundle\DataFixtures\ORM;


use adminBundle\Entity\produit;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProduitsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produit = new produit();
        $produit->setTitle('produit ')
            ->setDescription('lorem ipsum')
            ->setPrice(rand(1,1000))
            ->setQuantity(0);

        $brand = $this->getReference('nouvelle-marque');// on recuprer un brand
        //die(dump($brand));
              $produit->setMarque($brand);// on passe l'objet brand dans l'objet produit

        $manager->persist($produit);
        $manager->flush();
    }


    public function getOrder()
    {
        // Permet de choisir l'ordre d'execution des fixtures
        return 3;
    }
}