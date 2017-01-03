<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductsController extends Controller
{

    /**
     * @Route("/admin/produits")
     */
    public function produitsAction()
    {




        return $this->render('adminBundle:Products:products.html.twig');
    }
}
