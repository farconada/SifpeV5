<?php

namespace Fer\SifpeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GastoController extends Controller
{
    public function indexAction()
    {
        return $this->render('FerSifpeBundle:Gasto:index.html.twig', array('name' => 'test'));
    }
}
