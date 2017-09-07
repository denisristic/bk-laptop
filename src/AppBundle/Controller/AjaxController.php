<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 6.9.2017.
 * Time: 12:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Brand;
use AppBundle\Entity\Laptop;
use AppBundle\Entity\Model;
use PHP_CodeSniffer\Reports\Json;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{
    /**
     * @Route("/filter", name="price-filter")
     * @Method({"GET", "POST"})
     */
    public function filterPriceAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $laptopRepo = $manager->getRepository(Laptop::class);

        $laptops = $laptopRepo->getFilteredLaptops($request);

        return $this->render('filters/filters.html.twig', [
            'laptops' => $laptops,
        ]);
    }
}