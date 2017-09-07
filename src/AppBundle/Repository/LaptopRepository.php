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

    public function getFilteredLaptops($request) {
        $minPrice = $request->request->get('price')['minPrice'] ? $request->request->get('price')['minPrice'] : "0" ;
        $maxPrice = $request->request->get('price')['maxPrice'] ? $request->request->get('price')['maxPrice'] : "15000";

        $ram = $request->request->get('ram');
        $brand = $request->request->get('brand');
        $state = $request->request->get('state');

        $query = $this->createQueryBuilder('l')
            ->where('l.price BETWEEN '.$minPrice.'AND '.$maxPrice);

        if($ram) {
            $query = $query
                ->andWhere('l.ram IN (:ram)')
                ->setParameter('ram',$ram);
        }

        if($state) {
            $query = $query
                ->andWhere('l.state IN (:state)')
                ->setParameter('state',$state);
        }

        $laptops = $query->getQuery()->getResult();

        if($brand) {

            $finalResult = array();
            foreach ($laptops as $laptop) {
                if(in_array($laptop->getModel()->getBrand()->getId(),$brand))
                    $finalResult[] = $laptop;
            }
            return $finalResult;
        }

        return $laptops;
    }
}