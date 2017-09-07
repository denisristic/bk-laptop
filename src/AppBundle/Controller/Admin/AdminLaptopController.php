<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 7.9.2017.
 * Time: 13:25
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Laptop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class AdminLaptopController extends Controller
{
    /**
     * @Route("/admin/deactivate-laptop", name="deactivate_laptop")
     * @Method({"GET", "POST"})
     */
    public function ajaxDeactivateLaptopAction(Request $request) {

        $manager = $this->getDoctrine()->getManager();
        $laptopRepo = $manager->getRepository(Laptop::class);

        $laptopRepo->deactivateLaptopsById($request->request);

        $allLaptops = $laptopRepo->findAll();

        return $this->render('admin/adminhelper.html.twig', array(
            'laptops' => $allLaptops
        ));

    }

    /**
     * @Route("/admin/activate-laptop", name="activate_laptop")
     * @Method({"GET", "POST"})
     */
    public function ajaxActivateLaptopAction(Request $request) {
        $manager = $this->getDoctrine()->getManager();
        $laptopRepo = $manager->getRepository(Laptop::class);

        $laptopRepo->activateLaptopsById($request->request);

        $allLaptops = $laptopRepo->findAll();

        return $this->render('admin/adminhelper.html.twig', array(
            'laptops' => $allLaptops
        ));
    }
}