<?php

namespace adminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contactpage")
     */
    public function indexAction(Request $request)
    {
        $formContact = $this->createFormBuilder()// construction du formulaire
        ->add('firstname', TextType::class,['constraints'=>[
                                                             new  Assert\NotBlank(['message'=>'Merci de remplir ce champ']),
                                                             new Assert\Length(['min'=>2,
                                                                                 'minMessage'=>'Votre firstname doit faire au minimum 2 caractères '
                                                                               ])
                                                            ]])// ajouter les champs du formulaire
        ->add('lastname', TextType::class,['constraints'=>[
                                                            new Assert\NotBlank(['message'=>'Merci de remplir ce champ'])
                                                           ]])
            ->add('email', EmailType::class, ['constraints' => [
                                                                new Assert\NotBlank(['message' => 'Veuillez rentrer un email']),
                                                                new Assert\Email([
                                                                    'message' => 'Votre email {{ value }} est faux',
                                                                       ])
                                                                ]
                                             ]
               )
            ->add('content', TextareaType::class,['constraints'=>[ New Assert\NotBlank(['message'=>'Merci de remplir ce champ']),
                                                                   new Assert\Length([ 'max'=>150,
                                                                                        'maxMessage'=>'Vous avez le droit a 150 caractètes '])

                                                                  ]])
            ->getForm();


        $formContact->handleRequest($request);/// Je lie l'objet $request avec le formulaire.
        // Cela me permet de remplir le formulaire avec les informations tapées par l'utilisateur

        if ($formContact->isSubmitted() && $formContact->isValid()) {// tester si le  le formulaire est valide
//            // Dump de $_POST
//            dump($request->request->all());
//
//            // Dump de $_GET
//            dump($request->query->all());
//
//
//            /***
//             * recupérer les données avec post
//             */
//
//            // Récupérer les informations du formulaire
//            dump($formContact->getData());
//
//            // Récupérer une valeur précisément du formulaire
//            dump($formContact->get('firstname')->getData());
//
//            // La technique a utilisée est d'utiliser une varabiel ex: $data et de manipuler cette variable


            $data = $formContact->getData();

//            //recuperer un champ
//            dump($data['firstname']);
//
//
            // Envoie du mail

            $message = \Swift_Message::newInstance()
                ->setSubject('Formulaire de contact')
                ->setFrom($data['email'])
                ->setTo('contact@monsupersite.com')
                ->setBody(
                    $this->renderView('Email/formulaire-contact.html.twig', ['data' => $data]),
                    'text/html'
                )
                ->addPart(
                    $this->renderView('/Email/formulaire-contact.text.twig'),
                    'text/plain'
                );


            $this->get('mailer')->send($message);

            // Affichage d'un message de success
            $this->addFlash('success', 'Votre email a bien été envoyé');


            // Redirection

            return $this->redirectToRoute('contactpage');

        }


        return $this->render(':Contact:contact.html.twig', ['formContact' => $formContact->createView()]);
    }
}
