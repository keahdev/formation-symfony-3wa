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


    public function findarray($array){
        $qb=$this->createQueryBuilder('p');
        $qb->select('p')
            ->where('p.id IN (:array)')
            ->setParameter('array',$array);
        return $qb->getQuery()->getResult();

    }


    /**
     * Partie page produits dans le Public
     * Afficher les 6 derniers produits les plus chers par ordre décroissant de prix
     * @return array
     */
    public function sixlastproduits()
    {

        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.price', 'DESC')
            ->setMaxResults(6);
        return $qb->getQuery()->getResult();

    }


    public function getProduitsByPage($offset,$nbProductParPage)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->setFirstResult($offset)
            ->setMaxResults($nbProductParPage);

        $resultat = $qb->getQuery()->getResult();

        return $resultat;
    }




/****************** Requete qui recupere les produit selon id et la langue *****/

public function findProduitByLocale($id, $locale){

    $locale=strtoupper($locale);

    $produit=$this->createQueryBuilder('p')
        ->select("p.title$locale", "p.description$locale")
        ->where('p.id= :id')
        ->setParameter('id',$id)
        ->getQuery()
        ->getOneOrNullResult();

    return $produit;

}




    /**************************************************** *************************************************************/
    /****************************************************  REQUTES DE TEST ********************************************/
    /**************************************************** *************************************************************/


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
        $num = 38;
        $titre = 'mon titre';
        $qb = $this->createQueryBuilder('p')
            ->addSelect('m.titre')
            ->join('p.marque', 'm');

        /*$qb->select('COUNT(p.title) title')// utilisation d'un count avec un alias titre, on peut utiliser 'as titre' ou directment 'titre'
        ->groupBy('p.marque');// grouper selon le titre de marque*/

        /*$qb->select('p.title,b.titre')
            ->join('p.marque', 'b')// jointure avec la propriéte marque de l entité produit avec b comme alias
            ->where('p.quantity > :num')// quantité sup a un numero
            ->andWhere('p.title LIKE :titre')// titre egal a quel que chose
            ->setParameter('num',$num);  cas ou y a un seul where; le parametre comme dans PDO
            ->setParameters([     // cas ou y a where et/ou plusisuers andwhere, c-a-d une ou pluiseurs conditions
                'num' => $num,
                'titre' => '% $titre %'
            ])
           ->orderBy('p.title', 'ASC');// ordre sur le titre avec ascendant
        */
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
        $qb = $this->createQueryBuilder('p');
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
