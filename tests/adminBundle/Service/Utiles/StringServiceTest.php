<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 27/01/17
 * Time: 09:41
 */

namespace tests\adminBundle\Service\Utiles;
use adminBundle\Service\Utiles\StringService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class StringServiceTest extends WebTestCase
{

    public function testgenerateUniqId()
    {

        $stringService=New StringService();
        $value= $stringService->generateUniqId();

        $this->assertEquals(32, strlen($value));
    }

}