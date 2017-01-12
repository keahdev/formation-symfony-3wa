<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 12/01/17
 * Time: 09:47
 */

namespace adminBundle\Listener;


use adminBundle\Entity\produit;
use adminBundle\Service\Upload\UploadService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use \Doctrine\ORM\Event\PreUpdateEventArgs ;

class ProduitListener
{
    private $UploadService;

    /**
     * Charger le service UploadService
     * ProduitListener constructor.
     * @param UploadService $UploadService
     */

    public function __construct( UploadService $UploadService)
    {
        $this->UploadService=$UploadService;

    }


    /**
     * ici un evenement lors que la creation d'un enregistrment de la table
     * @param produit $entity
     */


    public function prePersist( produit $entity, LifecycleEventArgs $event){
        // remarque: lors de la crérion on doit tjrs mettre les deux dates
         $entity->setDatecreation(New \DateTime());
         $entity->setDatemodification(new \DateTime());


        /** faite appel au service uploadsevice**/


        $image= $entity->getImage();// on recupere l'image avec $entity car elle tape sur la classe Produit
        $filename=$this->UploadService->upload($image);//utiliser le service UploadService et la methode upload
        $entity->setImage($filename);// enregistrer l'image avec rénomage dans la table produit

    }

    /**
     * evenement apres modification d'un enregistrement de  la table ; on mis a jour la date de modification
     * @param produit $entity
     * @param PreUpdateEventArgs $event
     */

    public function preUpdate(produit $entity, PreUpdateEventArgs $event){

        $entity->setDatemodification(new \DateTime());

      }



}