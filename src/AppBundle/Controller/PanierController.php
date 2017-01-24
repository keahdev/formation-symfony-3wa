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

    /*public function createCart(Request $request){
        $session = $request->getSession();
        if(!$session->has('panier')){
            $session->set('panier', [
                'id' => [],
                'qty' => [],
            ]);
        }
        //dump($request->getSession()); die;
    }*/


    public function createCart(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) {
            $session->set('panier', []);
        }
        //dump($request->getSession()); die;
    }


    /**
     * @Route("/produit/panier/{id}", name="app.produit.panier")
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

        $prevURL = preg_split('/app_dev.php/', $request->server->get('HTTP_REFERER'));
        $router = $this->get('router');

        $prevURL = $router->match($prevURL[1])['_route'];
        return $this->redirectToRoute($prevURL);

    }

    /**
     * @Route("panier/show", name="app.panier.show")
     */
    public function showpanierAction(Request $request){

         $doctrine= $this->getDoctrine();

        $panierid= $request->getSession()->get('panier');

        // le mieux est de créer  une requete personnalisée avec in qui tape dans le tableua des id

        foreach ($panierid as $id=> $qty){
            $produit= $doctrine->getRepository('adminBundle:produit')->find($id);
            $produits[]=$produit;
        }


        return $this->render('Panier/panier.html.twig', ['produits'=>$produits]);
    }


}