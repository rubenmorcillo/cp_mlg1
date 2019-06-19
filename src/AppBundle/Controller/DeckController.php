<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Deck;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DeckType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeckController extends Controller
{

    /**
     * @Route("/deck/cr/{id}", name="deck_nuevo",requirements={"id": "\d+"})
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

            return $this->redirectToRoute('interfazJuego', ['id' => $usuario->getId()]);
        }
        return $this->render('deck/crearMazo.html.twig', [
            'es_nueva' => true,
            'form' => $form->createView(),
            ]);
    }
    /**
     * @Route("/deck/edit/{id}/{deck}", name="deck_editar",requirements={"id": "\d+", "deck": "\d+"})
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

            return $this->redirectToRoute('interfazJuego', ['id' => $usuario->getId()]);
        }
        return $this->render('deck/crearMazo.html.twig', [
            'es_nueva' => false,
            'form' => $form->createView(),
            'deck' => $deck,
            'usuario' => $usuario
        ]);
    }
    /**
     * @Route("/deck/dl/{id}/{deck}", name="deck_eliminar",requirements={"id": "\d+", "deck": "\d+"})
     */
    public function deckBorrarAction(Request $request,User $usuario, Deck $deck){
        if ($request->get('borrar') === ''){
            try{
                $this->getDoctrine()->getManager()->remove($deck);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'El escuadrón ha sido borrado');
                return $this->redirectToRoute('interfazJuego', ['id'=>$usuario->getId()]);

            }catch(\Exception $e){
                $this->addFlash('error', 'Ha ocurrido un error al eliminar el escuadrón');
            }
        }

        return $this->render('deck/eliminar.html.twig',[
           'usuario' => $usuario,
           'deck' => $deck
        ]);
    }
}
