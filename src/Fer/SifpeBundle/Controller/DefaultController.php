<?php

namespace Fer\SifpeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FerSifpeBundle:Default:index.html.twig', array('name' => $name));
    }
}
