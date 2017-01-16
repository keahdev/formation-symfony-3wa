<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 13/01/17
 * Time: 16:25
 */

namespace AppBundle\Controller;

use adminBundle\Entity\Comment;
use adminBundle\Entity\produit;
use adminBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{

    /**
     * @Route("/", name="app.index")
     */
    public function indexAction(){
        // Afficher les 6 derniers produits les plus chers par ordre décroissant de prix
        $doctrine=$this->getDoctrine();
        $produits=$doctrine->getRepository('adminBundle:produit')->sixlastproduits();

        return $this->render('Public/Produits/index.html.twig',['produits'=>$produits]);
    }



    /**
     * @Route("/produits/", name="app.produits")
     */

    public function produitsAction(Request $request){
        $doctrine=$this->getDoctrine();

        $page = $request->query->get('page', 1);// <=> $_GET['page'] le 1 est la valeur par defaut

        $nbProductPerPage = 6;
        if ($page<=0) $page = 1;

        $offset = ($page - 1) * $nbProductPerPage;

        $produits = $doctrine->getRepository('adminBundle:produit')->getProduitsByPage($offset);

        // TODO : changer par une requête SQL
        $nbProducts = count($doctrine->getRepository('adminBundle:produit')->findAll());
        $nbPagination = ceil($nbProducts / $nbProductPerPage);

        return $this->render('Public/Produits/produits.html.twig',['produits'=>$produits, 'nbPagination' => $nbPagination]);
        // for i in 1..nbPagination
        // {{ path('app.produits', {page : i}) }}
        // endfor
    }


    /**
     * @Route ("/produit/{id}", name="app.produit",requirements={"id":"\d+"})
     */

   public function produitAction(Request $request, $id){

        $comment= New Comment();

        $doctrine= $this->getDoctrine();
        $produit=$doctrine->getRepository('adminBundle:produit')->find($id);
       if(!$produit){
           throw  $this->createNotFoundException();
       }

       $form = $this->createForm(CommentType::class, $comment);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
           $em= $doctrine->getManager();
           $comment->setProduit($produit);
           $em->persist($comment);
           $em->flush();

       }



        return $this->render(':Public/Produits:showproduit.html.twig',['produit'=>$produit, 'form'=>$form->createView()]);
    }


}