<?php

namespace AppBundle\Controller;
use AppBundle\Repository\TypeCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TypeCardController extends Controller
{
    /**
     * @Route("/card", name="card_list")
     */
    public function usuarioListarAction(TypeCardRepository $typeCardRepository)
    {

        $todasCartas = $typeCardRepository->findAll();
        return $this->render('typeCard/list.html.twig', [
            'cards' => $todasCartas
        ]);
    }
}

