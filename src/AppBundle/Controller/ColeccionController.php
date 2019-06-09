<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ColeccionController extends Controller
{
    /**
    * @Route("/user/{id}", name="coleccion", requirements={"id": "\d+"})
    * @Security("is_granted('ROLE_USER')")
    */
    public function mainAction(UserRepository $userRepository, User $usuario)
    {

        return $this->render('coleccion/main.html.twig', [
            'usuario' => $usuario
        ]);
    }
}
