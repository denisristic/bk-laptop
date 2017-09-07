<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Laptop;
use AppBundle\Entity\Brand;
use AppBundle\Entity\State;
use AppBundle\Entity\Ram;
use AppBundle\Repository\LaptopRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $manager = $this->getDoctrine()->getManager();
        $filterData = array();

        $laptopRepo = $manager->getRepository(Laptop::class);
        $brandRepo = $manager->getRepository(Brand::class);
        $ramRepo = $manager->getRepository(Ram::class);
        $stateRepo = $manager->getRepository(State::class);
        $promoted = $laptopRepo->getPromotedLaptops();
        $topRated = $laptopRepo->getTopRatedLaptops();

        $brands = $brandRepo->findAll();
        $ram = $ramRepo->findAll();
        $state = $stateRepo->findAll();

        $filterData["ram"] = $ram;
        $filterData["brand"] = $brands;
        $filterData["state"] = $state;

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'promoted' => $promoted,
            'topRated' => $topRated,
            'filters' => $filterData
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function showContactAction(Request $request, \Swift_Mailer $mailer)
    {
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
                ->setFrom(array($formData["email"] => "General"))
                ->setTo('laptopstoreBK@gmail.com')
                ->setBody($formData["message"]."\n\n Please contact me on: ".$formData["email"]);

            $mailer->send($message);

            return $this->render('contact/contact.html.twig', array(
                'form' => $form->createView(),
                'formData' => $formData,
                'success' => "BRAVO!"
            ));
        }

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return $this->render('admin/admin.html.twig');
    }
}
