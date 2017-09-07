<?php
/**
 * Created by PhpStorm.
 * User: abaudoin
 * Date: 5.9.2017.
 * Time: 14:54
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Laptop;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LaptopController extends Controller
{
    /**
     * @Route("/laptop/{id}", name="laptop_show")
     */
    public function showLaptopAction($id, Request $request, \Swift_Mailer $mailer) {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(Laptop::class);
        $laptop = $repo->findOneBy(array('id' => $id));

        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Enter your name')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Enter your email')))
            ->add('message', TextareaType::class, array('attr' => array('rows' => '10', 'class' => 'form-control', 'placeholder' => 'Enter your message here')))
            ->add('send', SubmitType::class, array('label' => 'Send!', 'attr' => array('class' => 'btn btn-lg btn-danger')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $message = (new \Swift_Message())
                ->setSubject("Contact mail from LaptopStore")
                ->setFrom(array($formData["email"] => $laptop->getTitle()))
                ->setTo('laptopstoreBK@gmail.com')
                ->setBody($formData["message"]."\n\n Please contact me on: ".$formData["email"]."\n\n".$request->getUri());

            $mailer->send($message);

            return $this->render('contact/contact.html.twig', array(
                'form' => $form->createView(),
                'formData' => $formData,
                'success' => "BRAVO!"
            ));
        }
        return $this->render('laptop/laptop.html.twig', array(
            'laptop' => $laptop,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/filter", name="filter")
     * @Method({"GET", "POST"})
     */
    public function ajaxFilterLaptopAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $laptopRepo = $manager->getRepository(Laptop::class);

        $laptops = $laptopRepo->getFilteredLaptops($request->request);

        return $this->render('filters/filters.html.twig', [
            'laptops' => $laptops,
        ]);
    }
}