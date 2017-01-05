<?php

namespace adminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contactpage")
     */
    public function indexAction()
    {
        $formcontact = $this->createFormBuilder()
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('content', TextareaType::class)
            ->getForm();



        return $this->render(':Contact:contact.html.twig', ['formContact' => $formcontact->createView()]);
    }
}
