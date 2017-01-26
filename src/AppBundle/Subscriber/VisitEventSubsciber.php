<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 26/01/17
 * Time: 09:55
 */

namespace AppBundle\Subscriber;


use AppBundle\Event\VisitContactEvent;
use AppBundle\Event\VisitEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VisitEventSubsciber implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return [
            VisitEvents::CONTACT => 'visitContact'
        ];

    }

    public function visitContact(VisitContactEvent $event)
    {

        $ip = $event->getIp();// on recupere l'ip qui est dans le ContactController que on é déja traiter
        $date = New \DateTime();

        //ecrire les données dans le contactFormLogs .csv dans le dossier var
        file_put_contents('../var/contactFormLogs.csv',
            $ip . ';'.$date->format('d/m/Y H:i:s'). "\n", FILE_APPEND); // on  crée un fichier csv dans le dossier var


    }


}