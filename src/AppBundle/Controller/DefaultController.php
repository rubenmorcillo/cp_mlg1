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
     * @Route("/try", name="miMain")
     */
    public function pruebaAction()
    {
        // plantilla de la portada
        return $this->render('miMainPrueba.html.twig');
    }


}
