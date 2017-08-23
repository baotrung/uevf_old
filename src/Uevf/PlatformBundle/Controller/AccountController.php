<?php
namespace Uevf\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uevf\UserBundle\Entity\Account;
use Uevf\UserBundle\Form\AccountType;
use Uevf\UserBundle\Form\AccountEditType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AccountController extends Controller{

    public function editAction(Request $request){
        $session = $request->getSession();
        if(!$session->has('user_id')){
            $session->getFlashBag()->add('warning','You have to sign in first !');
            return $this->redirectToRoute('uevf_platform_signin');
        }
        $em = $this->getDoctrine()->getManager();
        $accRepo = $em->getRepository('UevfUserBundle:Account');
        $acc = $accRepo->findOneById($session->get('user_id'));
        $form = $this->get('form.factory')->create(AccountEditType::class, $acc);


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->merge($acc);
                $em->flush();
                $session->getFlashBag()->add('info', 'saved');
                return $this->redirectToRoute('uevf_platform_account_edit');
            }
        }

        return $this->render('UevfPlatformBundle:Account:editinfo.html.twig', array('editForm' => $form->createView()));
    }

    public function signupAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('user_id')) {
            $session->getFlashBag()->add('info', 'You are already connected !');
            return $this->redirectToRoute('uevf_platform_homepage');
        }
        $acc = new Account;
        $form = $this->get('form.factory')->create(AccountType::class, $acc);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $cityFrRepository = $em->getRepository('UevfPlatformBundle:CityFr');
                $city = $cityFrRepository->findOneBy(
                    array('zipcode' => $acc->getUser()->getcity()->getZipcode())
                );
                $acc->getUser()->setCity($city);
                $acc->getAvatar()->upload('avatar');
                try {
                    $em->persist($acc);
                    $em->flush();
                    return $this->redirectToRoute('uevf_platform_signin');
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $session->getFlashBag()->add('error', 'sign up failed, '.$e);
                    return $this->redirectToRoute('uevf_platform_signup');
                }

                $session->getFlashBag()->add('info', 'Congratulation!!! You can sign in now');
                return $this->redirectToRoute('uevf_platform_signin');

            }
        }

        return $this->render('UevfPlatformBundle:Site:signup.html.twig', array('signupForm' => $form->createView()));
    }

    public function signinAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('user_id')) {
            $session->getFlashBag()->add('info', 'You are already connected !');
            return $this->redirectToRoute('uevf_platform_homepage');
        }
        $form = $this->createFormBuilder()
            ->add('userId', TextType::class, array('label' => 'Username or Email'))
            ->add('password', PasswordType::class)
            ->add('signin', SubmitType::class, array('label' => 'Sign In'))
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                $accRepo = $this->getDoctrine()->getManager()->getRepository('UevfUserBundle:Account');
                $userRepo = $this->getDoctrine()->getManager()->getRepository('UevfUserBundle:User');
                $acc = $accRepo->findOneByUsername($data['userId']);
                if ($acc === null) {
                    $acc = $accRepo->findOneByUser($userRepo->findOneByEmail($data['userId']));
                    if ($acc === null) {
                        $session->getFlashBag()->add('info', 'Username/Email not exist');
                        return $this->redirectToRoute('uevf_platform_signin');
                    }
                }
                $auth = $this->container->get('uevf_platform.authentication');
                if ($auth->passwordMatching($data['password'], $acc->getPassword())) {
                    $session->set('user_id', $acc->getId());
                    $session->getFlashBag()->add('info', 'Hello '.$acc->getUsername());
                    return $this->redirectToRoute('uevf_platform_homepage');
                } else {
                    $session->getFlashBag()->add('info', 'wrong password');
                }
            }
        }

        return $this->render('UevfPlatformBundle:Site:signin.html.twig', array('signinForm' => $form->createView()));
    }

    public function signoutAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirectToRoute('uevf_platform_homepage');
    }

    public function editPwdActionRe(Request $request){

    }
}
