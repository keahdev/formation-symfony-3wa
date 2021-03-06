<?php

namespace adminBundle\Repository;


/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{


    public function getCommentByProduit($id)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.produit', 'p')
            ->where('c.produit = :id')
            ->setParameter('id', $id)
            ->orderBy('c.createAt', 'DESC');
        $resultat = $qb->getQuery()->getResult();

        return $resultat;


    }

}
