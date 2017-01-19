<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 16/01/17
 * Time: 12:10
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends Controller
{


    /**
     * @Route("/categories", name="app.categories")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function categoriesAction()
    {

        $doctrine = $this->getDoctrine();
        $categories = $doctrine->getRepository('adminBundle:Categorie')->findAll();


        return $this->render('Public/Categories/categories.html.twig', ['categories' => $categories]);

    }


    /**
     * @Route("/categorie/{id}", name="app.categorie", requirements={"id":"\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function categorieAction($id, Request $request)
    {

        $doctine = $this->getDoctrine();
        $categorie = $doctine->getRepository('adminBundle:Categorie')->find($id);// Recupre une catégorie

        $locale = $request->getLocale();// on recuprer la valeur locale c-a-d /fr ou /en
        $locale = strtoupper($locale); // transformer en majuscule la variable locale car elle est en locale dans la table ex: titleFr, TitleEN

        $produits = $doctine->getRepository('adminBundle:Categorie')->getProduitByCategorie($id, $locale);

        if (!$produits || !$categorie) {
            throw  $this->createNotFoundException();

        }


        return $this->render('Public/Categories/showcategorie.html.twig', ['categorie' => $categorie, 'produits' => $produits]);
    }


    /**
     * Renvoie toutes les categories pour le sidebar utlise la fonction render controller dans la vue twig
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function renderCategoriesAction()
    {
        $doctrine = $this->getDoctrine();
        $categories = $doctrine->getRepository('adminBundle:Categorie')->findAll();

        return $this->render('Public/Partials/main-sidebar.html.twig', ['categories' => $categories]);
    }


}