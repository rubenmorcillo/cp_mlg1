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
        $logeado = $this->getUser();
        // plantilla de la portada
        if ($logeado <> null){
            return $this->redirectToRoute('interfazJuego', ['id' =>$logeado->getId()]);
        }
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
