<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductsController extends Controller
{

    /**
     * @Route("admin/produits" ,name="produitspage")
     */
    public function produitsAction()
    {
        $products = [
            [
                "id" => 1,
                "title" => "Mon premier produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 10
            ],
            [
                "id" => 2,
                "title" => "Mon deuxième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 20
            ],
            [
                "id" => 3,
                "title" => "Mon troisième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 30
            ],
            [
                "id" => 4,
                "title" => "",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 410
            ],
        ];




        return $this->render(':Products:products.html.twig',['products'=>$products]);
    }




      //Methode pour recuprer  un seul produit

    /**
     * @Route("/admin/produit/{id}", name="produitpage",requirements={"id":"\d+"})
     */
    public function showproduitAction($id)
    {
        $products = [
            [
                "id" => 1,
                "title" => "Mon premier produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 10
            ],
            [
                "id" => 2,
                "title" => "Mon deuxième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 20
            ],
            [
                "id" => 3,
                "title" => "Mon troisième produit",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 30
            ],
            [
                "id" => 4,
                "title" => "",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('now'),
                "prix" => 410
            ],
        ];

        $tableau=[];

        foreach ( $products as $product){
            if($product['id']==$id){
                $tableau=$product;
                break;
            }
        }

        if (empty($tableau)){
            throw  $this->createNotFoundException('Oups produit non trouvé !!');
        }

        return $this->render(':Products:showproduct.html.twig',['product'=>$tableau]);
    }

}
