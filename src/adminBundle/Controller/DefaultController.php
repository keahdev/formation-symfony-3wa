<?php

namespace adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function indexAction()
    {

        return $this->render('adminBundle:Default:index.html.twig',['nom'=>'kelali','prenom'=>'ahcene']);
    }
}
