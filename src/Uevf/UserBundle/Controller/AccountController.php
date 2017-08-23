<?php

namespace Uevf\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uevf\UserBundle\Entity\Account;
use Uevf\UserBundle\Entity\User;
use Uevf\UserBundle\Entity\CityFr;
use Uevf\UserBundle\Form\UserType;

class AccountController extends Controller
{
    public function editinfoAction(Request $request)
    {
        $session = $request->getSession();
        $acc = $this->getUser();
        if ($acc->getUser() == null) {
            return $this->redirectToRoute('uevf_account_addinfo');
        }
        $user = $acc->getUser();
        $form = $this->get('form.factory')->create(UserType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $cityFrRepository = $em->getRepository('UevfPlatformBundle:CityFr');
                $city = $cityFrRepository->findOneBy(
                    array('zipcode' => $user->getcity()->getZipcode(), 'name' =>  $user->getcity()->getName())
                );
                $city_old = $user->getCity();
                $em->detach($city_old);
                $user->setCity($city);
                try {
                    $em->flush();
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $session->getFlashBag()->add('error', 'sign up failed, '.$e);
                    return $this->redirectToRoute('uevf_account_index');
                }
                return $this->redirectToRoute('uevf_account_index');
            }
        }

        return $this->render('UevfUserBundle:Profile:editinfo.html.twig', array('form' => $form->createView()));
    }

    public function addinfoAction(Request $request)
    {
        $session = $request->getSession();
        $acc = $this->getUser();
        if ($acc->getUser() !== null) {
            return $this->redirectToRoute('uevf_account_editinfo');
        }
        $user = new User;
        $form = $this->get('form.factory')->create(UserType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $cityFrRepository = $em->getRepository('UevfPlatformBundle:CityFr');
                $city = $cityFrRepository->findOneBy(
                    array('zipcode' => $user->getcity()->getZipcode(), 'name' =>  $user->getcity()->getName())
                );
                $user->setCity($city);
                $acc->setUser($user);
                try {
                    $em->flush();
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $session->getFlashBag()->add('error', 'sign up failed, '.$e);
                    return $this->redirectToRoute('uevf_account_index');
                }
                return $this->redirectToRoute('uevf_account_index');
            }
        }

        return $this->render('UevfUserBundle:Profile:editinfo.html.twig', array('form' => $form->createView()));
    }

    public function indexAction(){
        return $this->render('UevfUserBundle:Profile:index.html.twig');
    }

}
