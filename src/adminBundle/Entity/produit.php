<?php

namespace adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="adminBundle\Repository\produitRepository")
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
     * @Assert\NotBlank(message="Champ ne doit pas être vide")
     * @Assert\Length(min = 5, minMessage="Titre doit contenir minimum 5 caractères")
     * @Assert\Length(max = 100, maxMessage="Titre doit contenir minimum 100 caractères")
     *
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;


    /**
     * @Assert\NotBlank(message="Champ ne doit pas être vide")
     * @Assert\Length(max = 300, maxMessage="Déscription doit contenir au plus 300 caractères")
     *
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return produit
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }


    /**
     * Set marque
     *
     * @param \adminBundle\Entity\Brand $marque
     *
     * @return produit
     */
    public function setMarque(Brand $marque)
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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
