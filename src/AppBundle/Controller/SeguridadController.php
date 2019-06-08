<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeguridadController extends Controller
{
    /**
     * @Route("/entrar", name="usuario_entrar")
     */
    public function indexAction()
    {
        return $this->render('seguridad/entrar.html.twig');
    }

    public function salirAction(){

    }
}
