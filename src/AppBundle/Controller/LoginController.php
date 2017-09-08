<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\DomCrawler\Field\InputFormField;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{

//    /**
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
//        ]);
//    }

    /**
     * @Route("/login", name="login")
     */

    public function showContactAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('username', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'username')))
            ->add('password', PasswordType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'password')))
            ->add('login', SubmitType::class, array('label' => 'login!', 'attr' => array('class' => 'btn btn-lg btn-danger')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            return $this->render('security/login.html.twig', array(
                'form' => $form->createView(),
                'formData' => $formData,
                'success' => "Welcome!"
            ));
        }

        return $this->render('security/login.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
