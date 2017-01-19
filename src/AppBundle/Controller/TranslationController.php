<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 19/01/17
 * Time: 09:48
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * Class TranslationController
 * @package AppBundle\Controller
 * @Route("/{_locale}")
 */

class TranslationController extends Controller
{


    /**
     * @Route("/translation",name="app.translation")
     *
     */

    public function indexAction(Request $request){

        $locale=$request->getLocale();
        $doctrine=$this->getDoctrine();

        $produit=$doctrine->getRepository('adminBundle:produit')->findProduitByLocale(141, $locale);

        dump($produit);

        return $this->render('Public/translation/index.html.twig',['produit'=>$produit]);

    }

}