<?php

namespace OpiumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/Browse")
     */
    public function indexAction()
    {
        return $this->render('OpiumBundle:Default:index.html.twig');
    }
}
