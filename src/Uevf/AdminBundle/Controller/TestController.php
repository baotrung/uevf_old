<?php
namespace Uevf\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller{
    public function infosubmitAction(Request $request){
        $data = $request;
        if($request->isMethod('POST')){
            $data = $request;
        }
        return $this->render('UevfAdminBundle:Test:test.html.twig',array('data'=>$data));
    }
}
