<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 4.9.2017.
 * Time: 16:23
 */

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class LaptopRepository extends EntityRepository
{
    public function getPromotedLaptops()
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->where('l.promoted = 1')
            ->setMaxResults(5);

        return $qb->getQuery()
            ->getResult();
    }
}