<?php

namespace Uevf\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Uevf\UserBundle\Entity\Account;

class UsersController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $accRepo = $em->getRepository('UevfUserBundle:Account');
        $numberUser = $accRepo->countUser();
        $test =null;

        $arr_acc = array('username','email');
        $arr_user = array('firstname', 'lastname', 'tel');
        $em = $this->getDoctrine()->getManager();
        $accRepo = $em->getRepository('UevfUserBundle:Account');
        $accQb = $accRepo->createQueryBuilder('a')
            ->leftjoin('a.user','u')
            ->where('a.roles LIKE :role')->setParameter('role','%ROLE_USER%');

        $data = $accQb->getQuery()->getResult();
        if($request->isMethod('POST')){
            if($request->get("search") != null){
                $cpt = 0;
                foreach ($arr_acc as $criteria) {
                    if($request->get($criteria) != ""){
                        $attr = ':attr'.$cpt;
                        $cpt++;
                        $query = 'UPPER(a.'.$criteria.') = UPPER('.$attr.')';
                        $accQb->andWhere($query)->setParameter($attr,$request->get($criteria));
                    }
                }
                foreach ($arr_user as $criteria) {
                    if($request->get($criteria) != ""){
                        $attr = ':attr'.$cpt;
                        $cpt++;
                        $query = 'UPPER(u.'.$criteria.') = UPPER('.$attr.')';
                        $accQb->andWhere($query)->setParameter($attr,$request->get($criteria));
                    }
                }
                if("" != $request->get('birthday')){
                    $birthday = $request->get('birthday');
                    $date = date('Y-m-d',strtotime( $birthday ));
                    $accQb->andWhere('u.birthday = :birthday')->setParameter('birthday',$date);
                }
                if("" != $request->get('zipcode') && "" != $request->get('city')){
                    $cityFrRepository = $em->getRepository('UevfPlatformBundle:CityFr');
                    $city = $cityFrRepository->findOneBy(
                        array('zipcode' => $request->get('zipcode'), 'name' => $request->get('city'))
                    );
                    $accQb->andWhere('u.city = :city')->setParameter('city',$city);
                }
                $data = $accQb->getQuery()->getResult();
            }
            if(null != $request->get('modify')){
                $test = (int) $request->get('modify');
            }
            if(null != $request->get('delete')){
                $test = (int) $request->get('delete');
                $acc = $accRepo->findOneById($test);
                $em->remove($acc);
                $em->flush();
            }
        }
        return $this->render('UevfAdminBundle:Users:index.html.twig',array('numUser' => $numberUser,'data'=>$data, 'test' => $test));
    }
}
