<?php

namespace MI\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MIPlatformBundle:Default:index.html.twig');
    }
}
