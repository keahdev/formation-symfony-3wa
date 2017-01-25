<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 24/01/17
 * Time: 10:35
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PanierController extends Controller
{


    /**
     * Initialisation du panier ' a mettre comme service'
     * @param Request $request
     */
    public function createCart(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', []);
        }
        //dump($request->getSession()); die;
    }


    /**
     * Ajoute de produits dans la session panier
     * @Route("/produit/panier/{id}", name="app.produit.panier", requirements={"id":"\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function addpanierAction($id, Request $request)
    {

        $this->createCart($request);
        $session = $request->getSession();
        $panier = $session->get('panier');




        // $id=> $quantité
        if (array_key_exists($id, $panier)) {
            $panier[$id] += 1;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);


        // ici on retourne a la page précédent mais ne fonctionne pas lors de la pagination
        /*$prevURL = preg_split('/app_dev.php/', $request->server->get('HTTP_REFERER'));
        $router = $this->get('router');

        $prevURL = $router->match($prevURL[1])['_route'];
        return $this->redirectToRoute($prevURL);*/

        return $this->redirectToRoute('app.produits');
    }


    /**
     * Affiche  les produits dans le panier
     * @Route("panier/show", name="app.panier.show")
     */
    public function showpanierAction(Request $request)
    {

        $doctrine = $this->getDoctrine();

        $panier = $request->getSession()->get('panier');

        $produits = $doctrine->getRepository('adminBundle:produit')->findarray(array_keys($panier));

        //dump($produits); die();

        return $this->render('Panier/panier.html.twig', ['produits' => $produits]);
    }




    /**
     * @Route("/panier/update", name="app.panier.update")
     */
    public function updatepanierAction(Request $request){

        $session = $request->getSession();
        $panier = [];

        for($i = 0; $i < count($request->get('id')); $i++){
            $panier[$request->get('id')[$i]] = $request->get('qty')[$i];
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app.panier.show');
    }






    /**
     * Supprimer un produit du panier
     * @Route("panier/delete/{id}", name="app.panier.delete", requirements={"id":"\d+"})
     */
    public function deletepanierAction(Request $request, $id)
    {


        $this->createCart($request);
        $session = $request->getSession();
        $panier = $session->get('panier');



        if (array_key_exists($id, $panier)) {
           unset($panier[$id]);

            $this->addFlash('success','Produit supprimé de votre panier !');
            $session->set('panier', $panier);
        }
        return $this->redirectToRoute("app.panier.show");

    }


}