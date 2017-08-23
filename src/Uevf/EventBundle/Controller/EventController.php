<?php

namespace Uevf\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction()
    {
        return $this->render('UevfEventBundle:Event:index.html.twig');
    }
}
