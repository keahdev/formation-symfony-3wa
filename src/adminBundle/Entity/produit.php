<?php

namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="adminBundle\Repository\produitRepository")
 * @ORM\EntityListeners({"adminBundle\Listener\ProduitListener"})
 */
class produit
{

    /**
     * @ORM\ManyToOne (targetEntity="Brand")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Chmap ne doit pas être vide")
     */
    private  $marque;


    /**
     * @ORM\ManyToMany(targetEntity="Categorie",inversedBy="produits")
     * @ORM\JoinTable(name="produit_Categorie")
     *  @Assert\NotBlank(message="Chmap ne doit pas être vide")
     */
    private $categories;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="produit.titreFR")
     * @Assert\Length(min = 5, minMessage="Titre doit contenir minimum 5 caractères")
     * @Assert\Length(max = 100, maxMessage="Titre doit contenir minimum 100 caractères")
     *
     * @var string
     *
     * @ORM\Column(name="titleFR", type="string", length=100)
     */
    private $titleFR;




    /**
     * @Assert\NotBlank(message="produit.titreEN")
     * @Assert\Length(min = 5, minMessage="Titre doit contenir minimum 5 caractères")
     * @Assert\Length(max = 100, maxMessage="Titre doit contenir minimum 100 caractères")
     *
     * @var string
     *
     * @ORM\Column(name="titleEN", type="string", length=100)
     */
    private $titleEN;



    /**
     * @Assert\NotBlank(message="Champ ne doit pas être vide")
     * @Assert\Length(max = 300, maxMessage="Déscription doit contenir au plus 300 caractères")
     *
     * @var string
     *
     * @ORM\Column(name="descriptionFR", type="text", nullable=true)
     */
    private $descriptionFR;


    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEN", type="text")
     * @Assert\NotBlank(message="ce champ ne peux �tre null")
     */
    private $descriptionEN;




    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;



    /**
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $datecreation;// date de creation



    /**
     * @ORM\Column(name="datemodification", type="datetime")
     */
    private $datemodification; // date de modification



    /**
     * @ORM\Column(name="image", type="string")
     */
    private $image; 


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titleFR
     *
     * @param string $titleFR
     *
     * @return produit
     */
    public function setTitleFR($titleFR)
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    /**
     * Get titleFR
     *
     * @return string
     */
    public function getTitleFR()
    {
        return $this->titleFR;
    }

    /**
     * Set titleEN
     *
     * @param string $titleEN
     *
     * @return produit
     */
    public function setTitleEN($titleEN)
    {
        $this->titleEN = $titleEN;

        return $this;
    }

    /**
     * Get titleEN
     *
     * @return string
     */
    public function getTitleEN()
    {
        return $this->titleEN;
    }

    /**
     * Set descriptionFR
     *
     * @param string $descriptionFR
     *
     * @return produit
     */
    public function setDescriptionFR($descriptionFR)
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }

    /**
     * Get descriptionFR
     *
     * @return string
     */
    public function getDescriptionFR()
    {
        return $this->descriptionFR;
    }

    /**
     * Set descriptionEN
     *
     * @param string $descriptionEN
     *
     * @return produit
     */
    public function setDescriptionEN($descriptionEN)
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }

    /**
     * Get descriptionEN
     *
     * @return string
     */
    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return produit
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return produit
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return produit
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return produit
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set marque
     *
     * @param \adminBundle\Entity\Brand $marque
     *
     * @return produit
     */
    public function setMarque(\adminBundle\Entity\Brand $marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \adminBundle\Entity\Brand
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Add category
     *
     * @param \adminBundle\Entity\Categorie $category
     *
     * @return produit
     */
    public function addCategory(\adminBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \adminBundle\Entity\Categorie $category
     */
    public function removeCategory(\adminBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
