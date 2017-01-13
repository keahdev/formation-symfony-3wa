<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 13/01/17
 * Time: 12:11
 */

namespace adminBundle\Service\Utiles;


class UnlikService
{
    public $uploaddir;

    /**
     * le Contructeur a un parametre car dans l'argument  au service on a un parametre
     * UnlikService constructor.
     * @param $uploaddir
     */

    public function __construct($uploaddir)
    {
        $this->uploaddir = $uploaddir;

    }


    public function unlinkImage($file){
        $image=$this->uploaddir.$file;

        unlink($image);
    }

}