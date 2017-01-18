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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SecurityController extends Controller
{
 private $stringService;


    /**
     * @Route("/signin", name="security.signin")
     */


    public function signinAction(Request $request)
    {


        $user = New User();


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('post')) {

            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $rc=$doctrine->getRepository('AppBundle:Role');

            $data = $form->getData();

            $encoderpassword = $this->get('security.password_encoder');
            $password = $encoderpassword->encodePassword($data, $data->getPassword());
            $data->setPassword($password);

           $role= $rc->findOneBy(['name'=>'ROLE_USER']);
           $data->addRole($role);



        $token= $this->get('admin.service.utiles.string')->generateUniqId();

           // dump($token); die;
           /* $em->persist($data);
            $em->flush();*/


           $url=$data->getEmail();
            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmation de la création de compte')
                ->setFrom('contact@monsupersite.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('Email/confirmation.compte.html.twig', ['url' => $url]),
                    'text/html'
                );



            $this->get('mailer')->send($message);

            // Affichage d'un message de success
            //$this->addFlash('success', 'Votre email a bien été envoyé');

            // Redirection
            //return $this->redirectToRoute('app.index');
        }

        return $this->render('security/creatcompt.html.twig', ['form' => $form->createView()]);

    }


    /**
     * @Route("/login", name="security.login")
     */


    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }


    /**
     * @Route("/logout", name="security.logout")
     */


    public function logouAction(Request $request)
    {


    }

}