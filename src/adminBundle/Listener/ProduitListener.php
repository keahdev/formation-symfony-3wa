<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 12/01/17
 * Time: 09:47
 *
 * http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html
 */

namespace adminBundle\Listener;


use adminBundle\Entity\produit;
use adminBundle\Service\Upload\UploadService;
use adminBundle\Service\Utiles\UnlikService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use \Doctrine\ORM\Event\PreUpdateEventArgs ;

class ProduitListener
{
    private $UploadService;
    private $unlikService;
    private $image_load;

    /**
     * Charger le service UploadService car il est passé en argument dans le service
     * ProduitListener constructor.
     * @param UploadService $UploadService
     */

    public function __construct( UploadService $UploadService, UnlikService $unlikService)
    {
        $this->UploadService=$UploadService;
        $this->unlikService=$unlikService;

    }


    /**
     * ici un evenement lors que la creation d'un enregistrment de la table
     * @param produit $entity
     */


    public function prePersist( produit $entity, LifecycleEventArgs $event){
        // remarque: lors de la création on doit tjrs mettre les deux dates
         $entity->setDatecreation(New \DateTime());
         $entity->setDatemodification(new \DateTime());


        /** fait appel au service uploadsevice**/

        $image= $entity->getImage();// on recupere l'image avec $entity car elle tape sur la classe Produit

        if (is_null($image)){
            $filename='image-default.jpg';
        }else{
            $filename=$this->UploadService->upload($image);//utiliser le service UploadService et la methode upload
        }

        //$filename=$this->UploadService->upload($image);//utiliser le service UploadService et la methode upload

        $entity->setImage($filename);// enregistrer l'image avec rénomage dans la table produit

    }


    /**
     * charger l'image qui est déjà dans la table
     * @param produit $entity
     * @param LifecycleEventArgs $event
     */

    public function postLoad(produit $entity, LifecycleEventArgs $event) {

        $this->image_load=$entity->getImage();

    }



    /**
     * evenement apres modification d'un enregistrement de  la table ; on mis a jour la date de modification
     * @param produit $entity
     * @param PreUpdateEventArgs $event
     */

    public function preUpdate(produit $entity, PreUpdateEventArgs $event){

        $entity->setDatemodification(new \DateTime());

        $image=$entity->getImage();//image choisi par l'utilisateur

        if (is_null($image)){
            $filename=$this->image_load;// si l'image est nul c-a-d pas selectionner lors de edit alors on garde celle de la base
        }else{
            $filename=$this->UploadService->upload($image);//utiliser le service UploadService et la methode upload
            $this->unlikService->unlinkImage($this->image_load);
        }

        $entity->setImage($filename);// enregistrer l'image avec rénomage dans la table produit


      }



      public function preRemove(produit $entity, LifecycleEventArgs $event){

          $this->unlikService->unlinkImage($this->image_load);

      }




}