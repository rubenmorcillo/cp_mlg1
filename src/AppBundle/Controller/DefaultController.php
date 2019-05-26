<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="portada")
     */
    public function indexAction()
    {
        // plantilla de la portada
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/main", name="principal")
     */
    public function mainAction(Request $request)
    {

        return $this->render('default/main.html.twig', []);
    }
}
