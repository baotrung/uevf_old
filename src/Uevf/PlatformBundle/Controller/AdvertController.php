<?php
namespace Uevf\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uevf\PlatformBundle\Entity\Advert;
use Uevf\PlatformBundle\Form\AdvertType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdvertController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adverts = $em
            ->getRepository('UevfPlatformBundle:Advert')
            ->findAll();

        return $this->render('UevfPlatformBundle:Advert:index.html.twig',array('adverts' => $adverts));
    }

    public function showAction($id){
        $em = $this->getDoctrine()->getManager();
        $advert = $em
            ->getRepository('UevfPlatformBundle:Advert')
            ->findOneById($id);
        return $this->render('UevfPlatformBundle:Advert:show.html.twig',array('advert' => $advert));
    }

    public function createAction(Request $request)
    {
        //check if user is sign in or not
        $session = $request->getSession();
        if(!$session->has('user_id')){
            $session->getFlashBag()->add('warning','You have to sign in first !');
            return $this->redirectToRoute('uevf_platform_signin');
        }

        $advert = new Advert;
        $form = $this->get('form.factory')->create(AdvertType::class, $advert)->add("submit",SubmitType::class);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();

                //$session->getFlashBag()->add('info','advert is added !');
                //return $this->redirectToRoute('uevf_platform_advert_create');
            }
        }
        return $this->render('UevfPlatformBundle:Advert:create.html.twig',array('form' => $form->createView()));
    }
}
