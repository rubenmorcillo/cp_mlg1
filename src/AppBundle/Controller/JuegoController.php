<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Deck;
use AppBundle\Entity\User;
use AppBundle\Repository\DeckRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JuegoController extends Controller
{
    /**
     * @Route("/play/{id}", name="game_prepara")
     */
    public function preparaAction(Request $request,DeckRepository $dr, UserRepository $ur, User $user)
    {
        if ($request->get('ok') === 'buscar_oponente'){
//            $this->addFlash('error', 'nadie ha lanzado el formulario');

//            $this->addFlash('exito', 'formulario lanzado');
//            $oponente = $this->buscarOponenteAleatorio($user);
             $oponente = $this->buscarOponenteAleatorio($ur, $user);
             $sudeck = $this->crearMazoTemporal($oponente);
             $mideck = $request->get('deck_select');
             $mideck = $dr->unDeck($mideck)[0];
//            for ($i=0;$i< count($cartas_oponente); $i++) {
//                $this->addFlash('exito', $oponente->getNickname() .':' . $cartas_oponente[$i]);
//            }


//            $this->addFlash('exito', 'mazo:'.$miEscuad->getDeckName());

//            $miEscuad = $dr->findOneBy(['id'=> $miEscuad]);
//            for ($i=0;$i< count($misCartas); $i++){
//                $this->addFlash('exito', 'yo-c:'.$misCartas[$i]);
                 return $this->combateAction($user,$mideck, $oponente, $sudeck);
//            }


        }
        return $this->render('juego/main.html.twig', [
            'usuario' => $user,
            'decks' => $user->getDecks()
        ]);
    }

    public function buscarOponenteAleatorio(UserRepository $userRepository, User $usuario){
        $oponentes = $userRepository->buscarTodosMenosLogeado($usuario);
        $posibles_id  = [];
        foreach ($oponentes as $oponente){
        array_push($posibles_id, $oponente);
        }
        $max_op = count($posibles_id);
        $oponente_rnd = $posibles_id[mt_rand(1, $max_op)];
//        $oponente_rnd = 14;
        $oponente = $userRepository->find($oponente_rnd);
        return $oponente;
    }

    //le doy un User y me devuelve un array con 4 cartas aleatorias (pueden repetirse)
    public function buscar4CartasRnd(User $oponente){
        $cartas = $oponente->getCards();
        $cartas_enemigo = [];
        for ($i = 0; count($cartas_enemigo)<4;$i++){
            $cartaRnd = $cartas[mt_rand(1,count($cartas))];
            if ($cartaRnd <> ''){
                if (!in_array($cartaRnd, $cartas_enemigo)){
                    array_push($cartas_enemigo, $cartaRnd);
                }
            }
        }
        return $cartas_enemigo;

    }
    /**
     * @Route("/Combat/{jugador}/{mideck}/{oponente}/{sudeck}", name="game_combate")
     */
    public function combateAction( User $jugador,Deck $mideck, User $oponente, Deck $sudeck){
//        if( $_REQUEST->get('cartasJugador' === '' )){
//            $this->addFlash('exito', 'has pulsado validar');
//        }
//        $cartasJugador = [];
//        $miEscuad = $_REQUEST->get('deck_select');
//        $miEscuad = $dr->unDeck($miEscuad)[0];
//        $misCartas = $miEscuad->getCardsContained();
        $cartasOponente = $sudeck->getCardsContained();
        $cartasJugador = $mideck->getCardsContained();


        return $this->render('juego/combate.html.twig', [
            'jugador' => $jugador,
            'oponente' => $oponente,
            'cartasJugador' => $cartasJugador,
            'cartasOponente' => $cartasOponente,
            'deckJugador' => $mideck,
            'deckOponente' => $sudeck
        ]);
    }

    public function validarCombateAction(Request $request){
        if($request->get('validar')=== ''){
            $this->addFlash('exito', 'has pulsado validar');
        }

    }

    public function crearMazoTemporal(User $propietario){

        $cartasOponente = $this->buscar4CartasRnd($propietario);
        $mazo = new Deck();
        $mazo->setDeckName('default');
        $mazo->setCardsContained( $cartasOponente);
        $mazo->setDeckOwner($propietario);

        $this->getDoctrine()->getManager()->persist($mazo);
        $this->getDoctrine()->getManager()->flush();

        return $mazo;
    }



}
