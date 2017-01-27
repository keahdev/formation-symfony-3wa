<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 27/01/17
 * Time: 09:41
 */

namespace tests\adminBundle\Service\Utiles;

use adminBundle\Service\Utiles\StringService;
use adminBundle\Service\Utiles\UnlikService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UnlikServiceTest extends WebTestCase
{

    public function testRemove()
    {
        $container = $this->createClient()->getContainer();
        $uploaddir = $container->getParameter('upload_dir');// on accede  au container, puisque on est dans les tests doc il faut ajouter createClient() pour recuprer le paraùetre upload_dir du fichier config;

        $unlinkService = New UnlikService('tests/');
        file_put_contents('tests/tempFile.txt', 'content');// creer un fichier dans test
        $this->assertTrue(file_exists('tests/tempFile.txt'));/// tester la existe du fichier

        $unlinkService->unlinkImage('tempFile.txt');// tester la methode de suppression du fichier
        $this->assertTrue(!file_exists('tests/tempFile.txt'));// verifier si vraiment le fichier est supprimé

    }


}