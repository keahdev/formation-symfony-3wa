<?php

namespace adminBundle\Controller;

use adminBundle\Entity\Categorie;
use adminBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends Controller
{
    /**
     * @Route("categories",name="categoriespage")
     */

    public function categoriesAction()
    {

       $em=$this->getDoctrine()->getManager();

        $categories=$em->getRepository('adminBundle:Categorie')->findAll();

        return $this->render(':Categories:categories.html.twig',['categories'=>$categories]);
    }



    /**
     * @Route("categorie/cree", name="categoriecree")
     */
    public function creatAction(Request$request){
        $categorie = new Categorie();

        $formcategorie = $this->createForm(CategorieType::class, $categorie);
        $formcategorie->handleRequest($request);

        if ($formcategorie->isSubmitted() && $formcategorie->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $this->addFlash('success', 'Votre catégorie a bien été ajoutée');

            return $this->redirectToRoute('categoriespage');
        }
        return $this->render('Categories/creat.html.twig',['formcategorie'=>$formcategorie->createView()]);
    }



    /**
     * @Route("categorie/{id}", name="categoriepage", requirements={"id":"\d+"})
     */

    public function showcategoriAction($id){

        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('adminBundle:Categorie')->find($id);

        if (empty($categorie)){
            throw $this->createNotFoundException();
        }

        return $this->render(':Categories:showcategorie.html.twig',['categorie'=>$categorie]);

    }



    /**
     * @Route("/categoriet/edit/{id}", name="categoriedit",requirements={"id":"\d+"})
     */
    public function editproduitAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('adminBundle:Categorie')->find($id);

        if(!$categorie){
            throw $this->createNotFoundException();
        }

        $formcategorie = $this->createForm(CategorieType::class, $categorie);
        $formcategorie->handleRequest($request);

        if ($formcategorie->isSubmitted() && $formcategorie->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Catégorie modifiée');

            return $this->redirectToRoute('categoriespage');
        }
        return $this->render('Categories/edition.html.twig',['formcategorie'=>$formcategorie->createView(),'categorie'=>$categorie]);
    }

    /**
     * @Route("/categorie/supp/{id}", name="categoriesupp",requirements={"id":"\d+"})
     */

    public function suppproduitAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('adminBundle:Categorie')->find($id);
        if (!$categorie) {
            throw $this->createNotFoundException();
        }


        $em->remove($categorie);
        $em->flush();

        $this->addFlash('success', 'Votre catégorie a été supprimée');

        // Redirection sur la page toute les catégorie
        return $this->redirectToRoute('categoriespage');

    }




}
