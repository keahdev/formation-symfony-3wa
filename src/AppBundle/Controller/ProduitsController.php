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
    public function indexAction()
    {
        // Afficher les 6 derniers produits les plus chers par ordre décroissant de prix
        $doctrine = $this->getDoctrine();
        $produits = $doctrine->getRepository('adminBundle:produit')->sixlastproduits();

        return $this->render('Public/Produits/index.html.twig', ['produits' => $produits]);
    }


    /**
     * @Route("/produits/", name="app.produits")
     */

    public function produitsAction(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $page = $request->query->get('page', 1);// <=> $_GET['page'] le 1 est la valeur par defaut

        $nbProductParPage = 3;
        if ($page <= 0) $page = 1;

        $offset = ($page - 1) * $nbProductParPage;

        $produits = $doctrine->getRepository('adminBundle:produit')->getProduitsByPage($offset, $nbProductParPage);

        // TODO : changer par une requête SQL
        $nbProducts = count($doctrine->getRepository('adminBundle:produit')->findAll());

        $nbPagination = ceil($nbProducts / $nbProductParPage);

        //dump($nbPagination); die;

        return $this->render('Public/Produits/produits.html.twig', ['produits' => $produits, 'nbPagination' => $nbPagination]);

    }


    /**
     * @Route ("/produit/{id}", name="app.produit",requirements={"id":"\d+"})
     */

    public function produitAction(Request $request, $id)
    {

        $comment = New Comment();

        $doctrine = $this->getDoctrine();
        $produit = $doctrine->getRepository('adminBundle:produit')->find($id);
        if (!$produit) {
            throw  $this->createNotFoundException();
        }

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $comment->setProduit($produit);
            $em->persist($comment);
            $em->flush();
            $this->addFlash('success', 'Commentaite Posté !');
            return $this->redirectToRoute('app.produit', ["id" => $id]);
        }

        $commentbyproduit = $doctrine->getRepository('adminBundle:Comment')->getCommentByProduit($id);
        $countcomment = count($commentbyproduit);
        $moyenne = 0;
        foreach ($commentbyproduit as $score) {
            $moyenne = $score->getscore() + $moyenne;
        }

        /*$message = [];
        $message['moyenne'] = $moyenne;
        $message['countcomment'] = $countcomment;
        $session = $this->get('session');
        $session->set('message', $message);*/


        //$allcomment=$doctrine->getRepository('adminBundle:Comment')->findByproduit($id);


        return $this->render(':Public/Produits:showproduit.html.twig', ['produit' => $produit, 'commentbyproduit' => $commentbyproduit, 'countcomment' => $countcomment, 'moyenne' => $moyenne, 'form' => $form->createView()]);
    }


}