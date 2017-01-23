<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 23/01/17
 * Time: 12:04
 */

namespace adminBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KarnelEventSubscriber implements EventSubscriberInterface
{

    /*
     * ici on a créer un contructeur car dans le service admin.subscriber.karnel.events on a injecter un argument   twig
     * @var \Twig_Extension
     */

    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;

    }

    public static function getSubscribedEvents()
    {
        return[
           // KernelEvents::REQUEST=>'karnetRequest' // evenement requete
           KernelEvents::REQUEST=>'blockCountry',

            KernelEvents::RESPONSE => 'addCookiBlock'

        ];
    }



    /** evenement de la reponse ***/
      public function addCookiBlock(FilterResponseEvent $event){

          $content= $event->getResponse()->getContent(); // on recupere que le HTML de la page
          $content=str_replace('<body class="hold-transition skin-blue sidebar-mini">','<body class="hold-transition skin-blue sidebar-mini"><div class=" cookies alert alert-info text-center">Ce site utilise les cookies <a href="" class="btn btn-warning"> Ok</a></div>', $content);

          //dump($content); exit;

          $response= new Response($content);
          $event->setResponse($response);
      }




    public function blockCountry(GetResponseEvent $event)
    {
        //$ip=$event->getRequest()->getClientIp();// Ip du client

        // pour le test
        $ip='89.227.222.139';
        $ipservice=file_get_contents("http://www.webservicex.net//geoipservice.asmx/GetGeoIP?IPAddress=$ip");
        $xml=simplexml_load_string($ipservice); // transform une chaine en objet php en recupérer le CountryName
       // dump($xml->CountryName); die;// on recupere le nom du pays

        $content=$event->getResponse();// recuper la reponse

        if($xml->CountryName !='France'){// ici c'est un = car le resultat n'est pas une chaine mais un objet

            $view=$this->twig->render('Public/maintenance/maintenance.html.twig');
            $response=New Response($view, 503);// 503 est le code http d'une page de maintenance
            $event->setResponse($response);
        }

    }



    public function karnetRequest(GetResponseEvent $event){

        $request=$event->getRequest();// on recuper la requete
        $content=$event->getResponse();// recuper la reponse


       // dump( $request);
       // $lang = $request->server->get('HTTP_ACCEPT_LANGUAGE');


        $view=$this->twig->render('Public/maintenance/maintenance.html.twig');

        $response=New Response($view, 503);// 503 est le code http d'une page de maintenance
        $event->setResponse($response);
       // dump( 'karnel request'); die;


    }



}