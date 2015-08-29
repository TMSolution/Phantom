<?php

namespace PhantomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PhantomBundle:Default:index.html.twig' , array('name' => $name));
    }
}
