<?php

namespace Uevf\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Uevf\UserBundle\Entity\Account;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('UevfPlatformBundle:Site:index.html.twig');
    }

    public function testAction(){
        $account = $this->getUser();
        $test = $account->getUsername();
        return $this->render('UevfPlatformBundle:Site:test.html.twig',array('test'=>$test));
    }
}
