<?php
/**
 * Created by PhpStorm.
 * User: wamobi9
 * Date: 12/01/17
 * Time: 12:05
 */

namespace adminBundle\Service\Utiles;


class StringService
{

    public function generateUniqId(){
        $resultat= bin2hex(openssl_random_pseudo_bytes(16));// generer une chaine aléatoire
        return $resultat;
    }


}