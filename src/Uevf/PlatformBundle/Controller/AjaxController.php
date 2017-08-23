<?php
namespace Uevf\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Uevf\PlatformBundle\Entity\CityFr;

class AjaxController extends Controller
{
    public function showZipCodeAction(Request $request){
        $input = $request->get('input');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('UevfPlatformBundle:CityFr');
        $query = $repository->createQueryBuilder('c')
               ->where('c.zipcode LIKE :word')
               ->setParameter('word', $input.'%')
               ->getQuery();
        $results = $query->getResult();
        $citylist = array();
        foreach ($results as $city) {
            $citylist[] = array('id'=>$city->getId(),'zipcode'=>$city->getZipcode(),'name'=>$city->getName());
        }

        return new JsonResponse(array('citylist' => $citylist));
    }
}
