<?php

namespace Uevf\AdvertBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Uevf\AdvertBundle\Entity\Advert;
use Uevf\AdvertBundle\Entity\AdvertImage;
use Uevf\AdvertBundle\Form\AdvertType;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $advertRepo = $em->getRepository('UevfAdvertBundle:Advert');
        $adverts = $advertRepo->findAll();
        return $this->render('UevfAdvertBundle:Advert:index.html.twig',array('adverts' => $adverts));
    }

    public function createAction(Request $request){
        $advert = new Advert;
        $advert->setAuthor($this->getUser());
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
        if($request->isMethod('POST') && null != $request->get('submit')){
            $form->handleRequest($request);
            if($form->isValid() && $form->isSubmitted())
            {
                $advert->setAuthor($this->getUser());
                $advert->setCreationDate(new \DateTime());
                $advert->setModifyDate(new \DateTime());
                foreach ($advert->getUploads() as $upload) {
                    $image = new AdvertImage;
                    $image->upload($upload,$advert);
                    $advert->addImage($image);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();
            }
        }

        return $this->render('UevfAdvertBundle:Advert:create.html.twig',array('form' => $form->createView()));
    }

    public function detailAction($id)
    {
        $advert = $this->getDoctrine()->getManager()->getRepository('UevfAdvertBundle:Advert')->findOneById((int) $id);
        return $this->render('UevfAdvertBundle:Advert:detail.html.twig',array('advert' => $advert));
    }
}
