<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 5.9.2017.
 * Time: 12:03
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LaptopRepository extends EntityRepository
{
    public function getPromotedLaptops() {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->where('l.promoted = 1')
            ->setMaxResults(3);

        return $qb->getQuery()
            ->getResult();
    }

    public function getTopRatedLaptops() {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->orderBy('l.rating','DESC')
            ->setMaxResults(3);

        return $qb->getQuery()
            ->getResult();
    }
}