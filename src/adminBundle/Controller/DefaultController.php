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
     * @Route ("feedback", name="feedbackpage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function feedbackAction(Request $request)
    {
        $form1 = $this->createFormBuilder()
            ->add('page', TextType::class, ['constraints' => [
                New Assert\Url(['message' => 'Url non valide']),
                New Assert\NotBlank(['message' => ' Le champ ne doit pas être vide !'])
            ]])

            ->add('bug', ChoiceType::class, array('choices' => array('technique' => 1,
                                                                     'design'    => 2,
                                                                     'marketing' => 3,
                                                                     'autre'     => 4)))

            ->add('firstname', TextType::class, ['constraints' => [
                New Assert\NotBlank(['message' => 'Le champ ne doit pas être vide']),
                New Assert\Length(['min'        => 2,
                                   'minMessage' => 'min 2 caractères']),
            ]])

            ->add('lastname', TextType::class, ['constraints' => [
                New Assert\NotBlank(['message' => 'Le champ ne doit pas être vide']),
                New Assert\Length(['min'        => 2,
                                   'minMessage' => 'min 2 caractères'
                ])
            ]])

            ->add('email', EmailType::class, ['constraints' => [
                New Assert\NotBlank(['message' => 'Le champ ne doit pas être vide']),
                New Assert\Email(['message' => 'adresse email non valide'])
            ]])

            ->add('date', DateType::class,
                [
                    'years'  => range(date('Y') - 10, date('Y') + 10),
                    'format' => 'dd-MM-yyyy'
                ])

            ->add('content', TextareaType::class, ['constraints' => [
                New Assert\NotBlank(['message' => 'Le champ ne doit pas être vide'])
            ]])

            ->getForm();
        $form1->handleRequest($request);

        $data = $form1->getData();

        if ($form1->isSubmitted() && $form1->isValid()) {// tester si le  le formulaire est valide

            //Envoie de mail
            $message = \Swift_Message::newInstance()
                ->setSubject('Formulaire de feedback')
                ->setFrom($data['email'])
                ->setTo('contact@monsupersite.com')
                ->setBody(
                    $this->renderView('Email/formulaire-contact.html.twig', ['data' => $data]),
                    'text/html'
                )
                ->addPart(
                    $this->renderView('Email/formulaire-contact.text.twig'),
                    'text/plain'
                );

            $this->get('mailer')->send($message);
        }

        return $this->render('/Email/feedback .html.twig', ['form' => $form1->createView()]);
    }


}
