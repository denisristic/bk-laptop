<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 7.9.2017.
 * Time: 11:43
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Laptop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function showAdminPanelAction(Request $request) {

        $manager = $this->getDoctrine()->getManager();
        $laptopRepo = $manager->getRepository(Laptop::class);
        $allLaptops = $laptopRepo->findAll();

        return $this->render('admin/admin.html.twig', array(
            'laptops' => $allLaptops
        ));
    }
}