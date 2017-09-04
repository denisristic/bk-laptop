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
     * @ORM\Column(type="integer")
     */
    private $amount;
}