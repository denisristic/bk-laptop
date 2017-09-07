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
            ->andWhere('l.isActive = 1')
            ->setMaxResults(3);

        return $qb->getQuery()
            ->getResult();
    }

    public function getTopRatedLaptops() {
        $qb = $this->createQueryBuilder('l')
            ->select('l')
            ->Where('l.isActive = 1')
            ->orderBy('l.rating','DESC')
            ->setMaxResults(3);

        return $qb->getQuery()
            ->getResult();
    }

    public function getFilteredLaptops($data) {
        $minPrice = $data->get('price')['minPrice'] ? $data->get('price')['minPrice'] : "0" ;
        $maxPrice = $data->get('price')['maxPrice'] ? $data->get('price')['maxPrice'] : "15000";

        $ram = $data->get('ram');
        $brand = $data->get('brand');
        $state = $data->get('state');

        $query = $this->createQueryBuilder('l')
            ->where('l.price BETWEEN '.$minPrice.'AND '.$maxPrice)
            ->andWhere('l.isActive = 1');

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

    public function deactivateLaptopsById($data) {
        $laptopIds = $data->get('laptopIds');

        $this->createQueryBuilder('l')
            ->update('AppBundle:Laptop','l')
            ->where('l.id IN (:ids)')
            ->setParameter('ids', $laptopIds)
            ->set('l.isActive', 0)
            ->getQuery()->execute();
    }

    public function activateLaptopsById($data) {
        $laptopIds = $data->get('laptopIds');

        $this->createQueryBuilder('l')
            ->update('AppBundle:Laptop','l')
            ->where('l.id IN (:ids)')
            ->setParameter('ids', $laptopIds)
            ->set('l.isActive', 1)
            ->getQuery()->execute();
    }
}