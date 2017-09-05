<?php
/**
 * Created by PhpStorm.
 * User: vbubalo
 * Date: 5.9.2017.
 * Time: 12:37
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LogoutController extends Controller
{
    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        return $this->redirectToRoute('logout');
    }
}