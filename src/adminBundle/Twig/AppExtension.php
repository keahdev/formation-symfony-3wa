<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 13/01/17
 * Time: 14:31
 */

namespace adminBundle\Twig;


use Doctrine\Bundle\DoctrineBundle\Registry;

class AppExtension extends \Twig_Extension
{
private $doctrine;
private $twig;

public function __construct(Registry $doctrine, \Twig_Environment $twig)
{
    $this->doctrine = $doctrine;
    $this->twig = $twig;

}

public function getFunctions()
{


    return [
        New \Twig_SimpleFunction('ma_fonction', [$this, 'maFonction'])
    ];
}

public function maFonction()
{
$categories = $this->doctrine->getRepository('adminBundle:Categorie')->findAll();

return $this->twig->render(':Categories:categories.liste.html.twig', [
    'categories' => $categories
]);
}


}