<?php

/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 1.9.2017.
 * Time: 15:11
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="model")
 */
class Model
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     */
    private $brand;

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
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrandId($brand)
    {
        $this->brand = $brand;
    }


}