<?php
/**
 * Created by PhpStorm.
 * User: vbubalo
 * Date: 4.9.2017.
 * Time: 15:50
 */

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $form = $this->createFormBuilder()
            ->add('username', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Enter your username')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Enter your email')))
            ->add('password', PasswordType::class, array('attr' => array('rows' => '10', 'class' => 'form-control', 'placeholder' => 'Enter your password here')))
            ->add('plainPassword', PasswordType::class, array('attr' => array('rows' => '10', 'class' => 'form-control', 'placeholder' => 'Repeat your password here')))
            ->add('submit', SubmitType::class, array('label' => 'Register!', 'attr' => array('class' => 'btn btn-lg btn-danger')))
            ->getForm();





        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();
            $form->handleRequest($request);

            $formData = $form->getData();

            $form = $this->createForm(UserType::class, $user);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}