<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 20/01/17
 * Time: 09:37
 */

namespace adminBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategorieFormSubscriber implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return[
            FormEvents::POST_SET_DATA=>"postSetData"
        ];
    }


    /*
     * ici l'evenement c'est de modifier un champ du formulaire apres avoir cliquer sur le submit
     */
    public function postSetData(FormEvent $event){
        $entity=$event->getData();// recupere les données du formulaire
        $form= $event->getForm();// recupere le formulaire

         // ici on teste si le id existe dans la route, donc  c'est la mehode edit
        //  apres il faut supprimer le champ position
        if($entity->getId()){
            $form->remove('position');// on supprimer le champ position lors que update (edit)
            $form->add('description');// on ajoute le champ description dans le formulaire
        }else{// cas  formulaire de  creation c-a-d getid ==null
            $form->add('description',TextareaType::class, [
                'constraints'=>[
                    New NotBlank(['message'=>'La description est vide'])
                ]
            ]);

        }



        //dump($event); die;
    }


}