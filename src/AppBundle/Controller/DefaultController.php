<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $prenom="ahcene";
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'prenom'=>$prenom
        ]);
    }



    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $nom='Kelali';
        $prenom="ahcene";

        return $this->render('default/contact.html.twig', ['prenom'=>$prenom, 'nom'=>$nom]);
    }


    /**
     * @Route("/produit1", name="produit")
     */
    public function produitAction(Request $request)
    {
        $nom='Kelali';
        $prenom="ahcene";

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


        return $this->render('default/produit.html.twig',['produits'=>$products,'nom'=>$nom,'prenom'=>$prenom]);
    }


    /**
     * @Route("/bloc-mere", name="bloc-merepage")
     */
    public function blocmereAction(Request $request)
    {

        return $this->render('default/bloc-mere.html.twig' );
    }


    /**
     * @Route("/bloc-fille", name="bloc-fillepage")
     */
    public function blocfilleAction(Request $request)
    {


        return $this->render('default/bloc-fille.html.twig');
    }

    /**
     * @Route("/bloc-enfant", name="bloc-enfantepage")
     */
    public function blocenfantAction(Request $request)
    {


        return $this->render('default/bloc-enfant.html.twig');
    }





}
