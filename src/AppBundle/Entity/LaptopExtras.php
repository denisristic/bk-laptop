<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 4.9.2017.
 * Time: 10:38
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="laptop_extras")
 */
class LaptopExtras
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Laptop", inversedBy="laptopExtras")
     */
    private $laptop;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Extra", inversedBy="laptopExtras")
     */
    private $extra;

    /**
     * @return mixed
     */
    public function getLaptop()
    {
        return $this->laptop;
    }

    /**
     * @param mixed $laptop
     */
    public function setLaptop($laptop)
    {
        $this->laptop = $laptop;
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

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;
}