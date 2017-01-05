<?php

namespace adminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contactpage")
     */
    public function indexAction(Request $request)
    {
        $formContact = $this->createFormBuilder()// construction du formulaire
            ->add('firstname', TextType::class)// ajouter les champs du formulaire
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class)
            ->getForm();


        $formContact->handleRequest($request);/// Je lie l'objet $request avec le formulaire.
        // Cela me permet de remplir le formulaire avec les informations tapées par l'utilisateur

        if($formContact->isSubmitted() && $formContact->isValid() && $request->isMethod('post')){// tester si le  le formulaire est valide
            // Dump de $_POST
            dump($request->request->all());

            // Dump de $_GET
            dump($request->query->all());


            /***
             * recupérer les données avec post
             */

            // Récupérer les informations du formulaire
            dump($formContact->getData());

            // Récupérer une valeur précisément du formulaire
            dump($formContact->get('firstname')->getData());

            // La technique a utilisée est d'utiliser une varabiel ex: $data et de manipuler cette variable
            $data = $formContact->getData();

            dump($data['firstname']);

            die;

        }



        return $this->render(':Contact:contact.html.twig', ['formContact' => $formContact->createView()]);
    }
}
