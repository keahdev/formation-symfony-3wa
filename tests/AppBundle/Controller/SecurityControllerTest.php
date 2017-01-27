<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 27/01/17
 * Time: 12:19
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{


    public function testsignin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/signin');
        $container=$client->getContainer();


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Creation d\'un compte', $crawler->filter(' h3')->text());

        $username='username'.time();// generer un pseudo unique
        $password='password'.time();
        $email= 'email'.time().'@mail.com';


        $form= $crawler->selectButton('submit')->form([
            'appbundle_user[username]'=>$username,
            'appbundle_user[password]'=>$password,
            'appbundle_user[email]'=>$email,
        ]);
        $crawler=$crawler->submit($form);




    }

}