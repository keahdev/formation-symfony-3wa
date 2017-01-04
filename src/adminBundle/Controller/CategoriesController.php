<?php

namespace adminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    /**
     * @Route("categories",name="categoriespage")
     */

    public function indexAction()
    {

        $categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at.",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];


        return $this->render(':Categories:categories.html.twig',['categories'=>$categories]);
    }


    /**
     * @Route("categorie/{id}", name="categoriepage", requirements={"id":"\d+"})
     */

    public function showcategoriAction($id){

        $categories = [
            1 => [
                "id" => 1,
                "title" => "Homme",
                "description" => "lorem ipsum \n suite du contenu",
                "date_created" => new \DateTime('now'),
                "active" => true
            ],
            2 => [
                "id" => 2,
                "title" => "Femme",
                "description" => "<strong>lorem</strong> ipsum",
                "date_created" => new \DateTime('-10 Days'),
                "active" => true
            ],
            3 => [
                "id" => 3,
                "title" => "Enfant",
                "description" => "lorem ipsum",
                "date_created" => new \DateTime('-1 Days'),
                "active" => false
            ],
        ];

        $tableau=[];

        foreach ($categories as $categorie){
            if ($categorie['id'] == $id){
                $tableau=$categorie;
                break;
            }
        }

        if (empty($tableau)){
            throw $this->createNotFoundException('Oups categorie non trouvée !');
        }


        return $this->render(':Categories:showcategorie.html.twig',['categorie'=>$tableau]);


    }
}
