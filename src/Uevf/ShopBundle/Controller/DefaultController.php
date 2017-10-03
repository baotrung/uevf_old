<?php

namespace Uevf\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UevfShopBundle:Default:index.html.twig');
    }
}
