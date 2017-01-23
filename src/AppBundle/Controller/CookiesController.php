<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 23/01/17
 * Time: 16:36
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CookiesController extends Controller
{

    /**
     * @Route("/disclaimer-cookies", name="disclaimer-cookies")
     */
    public function disclaimerAction(Request $request){

      $disclaimer=$request->get('disclaimer');// recuperer la valeur de $disclaimer en GET qui est declarer en data dans ajax page Public.layout.html.twig


        $session=$request->getSession();
        $session->set('disclaimer',$disclaimer);


        dump($disclaimer, $session);exit;


    }

}