<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 4.9.2017.
 * Time: 10:23
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="extra")
 */
class Extra
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
    private $extra;

    /**
     * @ORM\OneToMany(targetEntity="LaptopExtras", mappedBy="extra")
     */
    private $laptopExtras;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param mixed $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }
}