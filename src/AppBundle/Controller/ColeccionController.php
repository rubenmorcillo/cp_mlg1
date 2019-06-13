<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Deck;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DeckType;
use AppBundle\Repository\CardRepository;
use AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ColeccionController extends Controller
{
    /**
    * @Route("/user/{id}", name="coleccion", requirements={"id": "\d+"})
    * @Security("is_granted('ROLE_USER')")
    */
    public function coleccionAction(CardRepository $cardRepository, User $usuario)
    {
        $cartas = $cardRepository->listarCartasUsuario($usuario);
        return $this->render('typeCard/list2.html.twig', [
            'usuario' => $usuario,
            'cards' => $cartas
        ]);
    }


//    /**
//     *
//     * @Route("/deck/{id}", name="deck_editar",
//     *     requirements={"id":"\d+"})
//     * @Security("is_granted('ROLE_PLAYER')")
//     */
//    public function formDeckAction(Request $request, Deck $deck)
//    {
//        $form = $this->createForm(DeckType::class, $deck);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            try {
//                $deck->setDeckOwner($this->getUser());
//                $this->getDoctrine()->getManager()->flush();
////                $this->addFlash('exito', 'Los cambios en el equipo han sido guardados con éxito');
//                return $this->redirectToRoute('coleccion');
//            } catch (\Exception $e) {
////                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
//            }
//        }
//
//        return $this->render('coleccion/crearMazo.html.twig', [
//            'form' => $form->createView(),
//            'deck' => $deck,
//            'es_nueva' => $deck->getId() === null
//        ]);
//    }
    /**
     *
     * @Route("/deck/{id}", name="deck_editar",
     *     requirements={"id":"\d+"})
     * @Security("is_granted('ROLE_PLAYER')")
     */
    public function formDeckAction(Request $request, Deck $deck,CardRepository $cardRepository)
    {
        $cartasPropias=$cardRepository->listarCartasUsuario($this->getUser());
        $form = $this->createForm(DeckType::class, $deck);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $deck->setDeckOwner($this->getUser());
                $this->getDoctrine()->getManager()->flush();
//                $this->addFlash('exito', 'Los cambios en el equipo han sido guardados con éxito');
                return $this->redirectToRoute('coleccion');
            } catch (\Exception $e) {
//                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }

        return $this->render('coleccion/crearMazo.html.twig', [
            'form' => $form->createView(),
            'deck' => $deck,
            'es_nueva' => $deck->getId() === null
        ]);
    }


    /**
     * @Route("/deck/cr", name="deck_nuevo")
     * @Security("is_granted('ROLE_PLAYER')")
     */
    public function formNuevoDeckAction(CardRepository $cardRepository,Request $request)
    {
        $deck = new Deck();

        $this->getDoctrine()->getManager()->persist($deck);
        return $this->formDeckAction($request, $deck, $cardRepository);
    }

//    /**
//     * @Route("/equipo/eliminar/{id}", name="equipo_eliminar")
//     * @Security("is_granted('ROLE_ADMIN')")
//     */
//    public function eliminarAction(Request $request, Equipo $equipo)
//    {
//        if ($request->get('borrar') === '') {
//            try {
//                $jugadores = $equipo->getPlantilla();
//
//                foreach ($jugadores as $jugador){
//                    $jugador->setEquipo(null);
//
//                }
//
//
//                if ($equipo->getEntrenador() != null){
//                    $equipo->getEntrenador()->setEquipoEntrenado(null);
//                }
//
//                $this->getDoctrine()->getManager()->remove($equipo);
//                $this->getDoctrine()->getManager()->flush();
//                $this->addFlash('exito', 'El equipo ha sido borrado');
//                return $this->redirectToRoute('equipos');
//            } catch (\Exception $e) {
//                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
//            }
//        }
//        return $this->render('default/eliminarEquipo.html.twig', [
//            'equipo' => $equipo
//        ]);

}
