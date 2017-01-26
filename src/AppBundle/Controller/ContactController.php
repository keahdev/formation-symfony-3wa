<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 26/01/17
 * Time: 10:13
 */

namespace AppBundle\Controller;


use AppBundle\Event\VisitContactEvent;
use AppBundle\Event\VisitEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class ContactController extends Controller
{


    /**
     * @Route("/contact", name="app.contact")
     * @param Request $request
     */
    public function conatctAction(Request $request){

        $venentDispatcher = $this->get('debug.event_dispatcher');// service de symfony

        $event=New VisitContactEvent();// notre evenement
        $event->setIp($request->getClientIp());// recupere 'IP

        $venentDispatcher->dispatch(VisitEvents::CONTACT,$event);// declenche d'evement

        // on recuprer les données du fichier contactFormLogs pour les lire dans la vue
        $fileCSV=file('../var/contactFormLogs.csv');


        return $this->render('contacttest.htm.twig', ['fileCSV'=>$fileCSV]);

    }
}


