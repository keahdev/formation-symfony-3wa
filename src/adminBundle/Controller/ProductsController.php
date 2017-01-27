<?php

namespace adminBundle\Controller;

use adminBundle\Entity\produit;
use adminBundle\Form\produitType;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ProductsController extends Controller
{

    /**
     * @Route("/produits" ,name="produitspage")
     */
    public function produitsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('adminBundle:produit')->findAll();


        return $this->render(':Products:products.html.twig', ['products' => $products]);
    }



    /**
     * @Route("produit/cree", name="produitcree")
     */
    public function creatAction(Request $request)
    {
        $produit = new produit();

        $formproduit = $this->createForm(produitType::class, $produit);
        $formproduit->handleRequest($request);

        if ($formproduit->isSubmitted() && $formproduit->isValid()) {

            /**Enregistrement des données dans la table produit*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->addFlash('success', 'Votre produit a bien été ajouté');

            return $this->redirectToRoute('produitspage');
        }
        return $this->render('Products/creat.html.twig', ['formproduit' => $formproduit->createView()]);
    }





    /**
     * @Route("/produit/{id}", name="produitpage",requirements={"id":"\d+"})
     */
    public function showproduitAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('adminBundle:produit')->find($id);
        if (!$product) {
            throw  New EntityNotFoundException();
        }
        return $this->render(':Products:showproduct.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/produit/edit/{id}", name="produitedit",requirements={"id":"\d+"})
     */
    public function editproduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('adminBundle:produit')->find($id);


        if (!$produit) {
            throw $this->createNotFoundException();
        }
        $formproduit = $this->createForm(produitType::class, $produit);
        $formproduit->handleRequest($request);

        if ($formproduit->isSubmitted() && $formproduit->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Produit modifié');

            return $this->redirectToRoute('produitspage');
        }
        return $this->render('Products/edition.html.twig', ['formproduit' => $formproduit->createView(), 'produit' => $produit]);
    }



    /**
     * @Route("/produit/supp/{id}", name="produitsupp",requirements={"id":"\d+"})
     */

    public function suppproduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('adminBundle:produit')->find($id);
        if (!$produit) {
            throw $this->createNotFoundException();
        }

        $em->remove($produit);
        $em->flush();


        /** pour gerer la supp avec ajax */

        $message_success = "Produit bien été supprimé";

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['message' => $message_success]);
        }


        $this->addFlash('success', 'Votre produit a été supprimé');

        // Redirection sur la page qui liste tous les produits
        return $this->redirectToRoute('produitspage');

    }
}
