<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/');// /fr/ car pour accéder a ma page d'accueil j'ai la traduction

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('A Warm Welcome!', $crawler->filter('.jumbotron  h1')->text());// teste si dans .jumbotron  h1' j'ai le text 'A Warm Welcome!'
        $this->assertGreaterThan(0, $crawler->filter('ul')->count());// revoie le nm de h dans la page

        $link=$crawler->selectLink('je clique ici')->link();// tester un lien <a>, dans ma page j'ai un lien avec 'un text je clique ici'


    }
}