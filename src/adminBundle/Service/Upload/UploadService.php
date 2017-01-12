<?php


namespace adminBundle\Service\Upload;

use adminBundle\Service\Utiles\StringService;

class UploadService
{

    private $serviceUtilesString;
    private $uploadDir;

    /**
     * UploadService constructor.
     * @param StringService $serviceUtilesString
     * @param $uploadDir
     */

    public function __construct(StringService $serviceUtilesString, $uploadDir)
    {
        $this->serviceUtilesString = $serviceUtilesString;
        $this->uploadDir = $uploadDir;

    }

    /**
     * @param $image
     * @return string
     */

    public function upload($image)
    {

        $name = $this->serviceUtilesString->generateUniqId();// generer un name avec notre service pour image
        $filename = $name . "." . $image->guessExtension();// le nom de l'image avec l'extension

        $image->move($this->uploadDir, $filename);// move deplace l'image et guessEtension recuprer l'extension du fichier

        return $filename;

    }


}