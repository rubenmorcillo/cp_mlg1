<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JuegoController extends Controller
{
    /**
     * @Route("/play&u={id}", name="game_prepara")
     */
    public function preparaAction(Request $request, User $user)
    {
        if (count($_REQUEST) == 0){
            $this->addFlash('error', 'nadie ha lanzado el formulario');
        }else{
            $this->addFlash('exito', 'formulario lanzado');
        }
        return $this->render('juego/main.html.twig', [
            'usuario' => $user
        ]);
    }



}
