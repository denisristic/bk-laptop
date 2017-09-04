<?php

/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 1.9.2017.
 * Time: 15:03
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="laptop")
 */
class Laptop
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @@ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Model")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="State")
     */
    private $state;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=2000, max=2017, minMessage="Earliest year is 2000", maxMessage="Latest year is 2017")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Ram")
     */
    private $ram;

    /**
     * @ORM\OneToMany(targetEntity="LaptopExtras", mappedBy="laptop")
     */
    private $laptopExtras;

    /**
     * @return mixed
     */

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="laptop")
     */
    private $images;

    public function __construct() {
        $this->images = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $promoted;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=5, minMessage="Minimum rating is 0", maxMessage="Maximum rating is 5")
     */
    private $rating;

    /**
     * GETTERS AND SETTERS
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param mixed $ram
     */
    public function setRam($ram)
    {
        $this->ram = $ram;
    }

    public function getLaptopExtras()
    {
        return $this->laptopExtras;
    }

    /**
     * @param mixed $laptopExtras
     */
    public function setLaptopExtras($laptopExtras)
    {
        $this->laptopExtras = $laptopExtras;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getPromoted()
    {
        return $this->promoted;
    }

    /**
     * @param mixed $promoted
     */
    public function setPromoted($promoted)
    {
        $this->promoted = $promoted;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }




}