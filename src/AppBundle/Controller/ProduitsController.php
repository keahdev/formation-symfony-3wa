<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 13/01/17
 * Time: 16:25
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{


    /**
     * @Route("/produits", name="app.produits")
     */

    public function produitsAction(){

        return $this->render('Public/Produits/produits.html.twig');

    }

}