<?php

namespace AppBundle\Controller;
use AppBundle\Entity\User;
use AppBundle\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends Controller
{

    /**
     * @Route("/user/{id}/coleccion", name="coleccion", requirements={"id": "\d+"})
     */
    public function cardListAction(CardRepository $cardRepository, User $usuario){
        $cartas = $usuario->getCards();
        return $this->render('typeCard/list2.html.twig', [
            'usuario' => $usuario,
            'cards' => $cartas
        ]);

    }
}

