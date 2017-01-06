<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class DefaultController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function indexAction()
    {

        return $this->render(':Default:index.html.twig');
    }


    /**
     * @Route ("feedback")
     */
    public function feedbackAction(Request $request)
    {
        /**
         * Creation du formulaire
         */

        $form1 = $this->createFormBuilder()
            ->add('page', TextType::class,['constraints'=>[
                                                new Assert\Url(['message'=>'Url non valide']),
                                                new Assert\NotBlank(['message'=>' le champ ne doit pas etre vide !'])

                                              ]])
            ->add('bug', ChoiceType::class, array('choices' => array('technique' => 1,
                'design' => 2,
                'marketing' => 3,
                'autre'=>4)))
            ->add('firstname', TextType::class,['constraints'=>[
                                                                 New Assert\NotBlank(['message'=>'le champ ne doit pas etre vide']),
                                                                 New Assert\Length(['min' => 2,
                                                                                   'minMessage'=>'min 2 caractères']),

                                                               ]])
            ->add('lastname', TextType::class,['constraints'=>[
                                                                New Assert\NotBlank(['message'=>'le champ ne doit pas etre vide']),
                                                                New Assert\Length(['min'=>2,
                                                                                    'minMessage'=>'min 2 caractères'
                                                                ])

                                                                ]])
            ->add('email', EmailType::class,['constraints'=>[
                                                             new Assert\NotBlank(['message'=>'Le champ ne doit pas etre vide']),
                                                             New Assert\Email(['message'=>'adresse email non valide'])

                                                            ]])
            ->add('date', DateType::class,
                [
                    'years' => range( date('Y')-10, date('Y')+10 ),
                    'format'=>'dd-MM-yyyy'
                ])
            ->add('content', TextareaType::class)

          ->getForm();
        $form1->handleRequest($request);

        $data=$form1->getData();


         $mots=['zut', 'mince', 'mer**', 'breton', 'vendéen'];

          /*foreach ($mots as $mot){
              if(preg_match())
          }*/
          $content=$data['content'];


        dump($content[1]);
        die();


        /**
         * Envoie de mail
         */

        /*$message = \Swift_Message::newInstance()
            ->setSubject('Formulaire de feedback')
            ->setFrom($data['email'])
            ->setTo('contact@monsupersite.com')
            ->setBody(
                $this->renderView('Email/formulaire-contact.html.twig'),
                'text/html'
            )
            ->addPart(
                $this->renderView('Email/formulaire-contact.text.twig'),
                'text/plain'
            );


        $this->get('mailer')->send($message);*/



        return $this->render('/Email/feedback .html.twig', ['form' => $form1->createView()]);
    }


}
