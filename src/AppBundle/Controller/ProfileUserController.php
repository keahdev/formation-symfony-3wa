<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 17/01/17
 * Time: 16:36
 */

namespace AppBundle\Controller;



use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ProfileUserController extends Controller
{

    /**
     * @Route("/profile", name="app.profile")
     */

    public function profileAction(Request $request){
        //$user= $this->getUser();
        //dump($this->isGranted());

        // dump($user->id); die;


        $form= $this->createForm(UserType::class);
        $form->handleRequest($request);

        return $this->render('Profile/profile.html.twig',['form'=>$form->createView()]);
    }


}