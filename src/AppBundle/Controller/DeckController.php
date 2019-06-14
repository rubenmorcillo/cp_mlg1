<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Deck;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DeckType;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeckController extends Controller
{

    /**
     * @Route("/deck/cr/ow={id}", name="deck_nuevo")
     */
    public function deckNuevoAction(User $usuario,Request $request)
    {

        $deck = new Deck();
        $deck->setDeckOwner($usuario);
        $form = $this->createForm(DeckType::class, $deck);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($deck);
            $em->flush();

            return $this->redirectToRoute('coleccion', ['id' => $usuario->getId()]);
        }
        return $this->render('coleccion/crearMazo.html.twig', [
            'es_nueva' => true,
            'form' => $form->createView(),
            ]);
    }
    /**
     * @Route("/deck/edit/cr/ow={id}/{deck}", name="deck_editar")
     */
    public function deckEditarAction(User $usuario,Request $request, Deck $deck)
    {


        $deck->setDeckOwner($usuario);
        $form = $this->createForm(DeckType::class, $deck);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($deck);
            $em->flush();

            return $this->redirectToRoute('coleccion', ['id' => $usuario->getId()]);
        }
        return $this->render('coleccion/crearMazo.html.twig', [
            'es_nueva' => false,
            'form' => $form->createView(),
        ]);
    }
}
