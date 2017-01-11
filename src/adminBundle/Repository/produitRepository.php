<?php

namespace adminBundle\Repository;
use adminBundle\Entity\produit;

/**
 * produitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class produitRepository extends \Doctrine\ORM\EntityRepository
{


    public function getAllproduit()
    {
        // Creation d'une requête DQL
        // findAll() maison

        $qb = $this->createQueryBuilder('p')
        ->select('p.id');

        $produit = $qb->getQuery()->getResult();
        die((dump($produit)));


    }





    // Afficher les produits dont la quantité est inférieur à 5
    public function quantsupcinq()
    {
        $num=38;
        $qb = $this->createQueryBuilder('p');
        $qb->select('p.title,b.titre')
            ->join('p.marque', 'b')
            ->where('p.quantity > :num')
        ->setParameter('num',$num);
        $produit = $qb->getQuery()->getResult();
        die((dump($produit)));

    }












    // Afficher le nombre de produit dont la quantité est à 0
    public function quantegalzero()
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('COUNT(p)')
          ->where('p.quantity = 0');
        $produit = $qb->getQuery()->getResult();
        die((dump($produit)));

    }

    // Afficher le total des produits
    public function sumprice()
    {
        $qb= $this->createQueryBuilder('p');
           $qb->select('SUM(p.price)');
        $produit = $qb->getQuery()->getSingleScalarResult();
        die((dump($produit)));
    }

    //Afficher la quantité total des produits
    public function somquanti()
    {
        //$qb = $this->createQueryBuilder('p');
        //$produit = ($qb->getQuery()->getResult());
        //die((dump($produit)));
    }




}
