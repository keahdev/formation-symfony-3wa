<?php

namespace adminBundle\Controller;

use adminBundle\Entity\produit;
use adminBundle\Form\produitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller
{

    /**
     * @Route("/produits" ,name="produitspage")
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







    /**
     * Creattion d'un nouveau produit
     */

    /**
     * @Route("produit/cree", name="produitcree")
     */
    public function creatAction(Request $request){


        $produit = new produit();

        $formproduit = $this->createForm(produitType::class, $produit);
        $formproduit->handleRequest($request);


        if ($formproduit->isSubmitted() && $formproduit->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->addFlash('success', 'Votre produit a bien été ajouté');

            return $this->redirectToRoute('produitcree');
        }


        return $this->render('Products/creat.html.twig',['formproduit'=>$formproduit->createView()]);

    }

























    //Methode pour recuprer  un seul produit

    /**
     * @Route("/produit/{id}", name="produitpage",requirements={"id":"\d+"})
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

        $prixmin=0;


        return $this->render(':Products:showproduct.html.twig',['product'=>$tableau]);
    }

}
