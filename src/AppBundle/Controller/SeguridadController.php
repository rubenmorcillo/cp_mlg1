<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SeguridadController extends Controller
{
    /**
     * @Route("/login", name="usuario_entrar")
     */
    public function indexAction(AuthenticationUtils $authenticationUtils )
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $ultimoUsuario = $authenticationUtils->getLastUsername();

        return $this->render('seguridad/entrar.html.twig', [
            'error' => $error,
            'ultimo_usuario' => $ultimoUsuario
        ]);
    }
    /**
     * @Route("/salir", name="usuario_salir")
     */
    public function salirAction(){

    }


}
