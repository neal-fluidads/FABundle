<?php

namespace Fluidads\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FluidadsApiBundle:Default:index.html.twig');
    }
}
