<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Battle;
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
        if($user <> $this->getUser()){
            $user = $this->getUser();
        }
        if ($request->get('ok') === 'buscar_oponente'){

             $oponente = $this->buscarOponenteAleatorio($ur, $user);
             $sudeck = $this->crearMazoTemporal($oponente);
             $mideck = $request->get('deck_select');
             $mideck = $dr->unDeck($mideck)[0];
             return $this->combateAction($request, $user,$mideck, $oponente, $sudeck);


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
        $max_op = count($posibles_id)-1;
        $oponente_rnd = $posibles_id[mt_rand(0, $max_op)];
        $oponente = $userRepository->find($oponente_rnd);
        return $oponente;
    }

    //le doy un User y me devuelve un array con 4 de sus cartas aleatorias (SIN REPETIDOS)
    public function buscar4CartasRnd(User $oponente){
        $cartas = $oponente->getCards();
        $cartas_enemigo = [];
        for ($i = 0; count($cartas_enemigo)<4;$i++){
            $cartaRnd = $cartas[mt_rand(0,count($cartas))];
            if ($cartaRnd <> ''){
                if (!in_array($cartaRnd, $cartas_enemigo)){
                    array_push($cartas_enemigo, $cartaRnd);
                }
            }
        }
        return $cartas_enemigo;

    }
    /**
     * @Route("/Combat/{jugador}/{mideck}/{oponente}/{sudeck}", name="game_combate", methods="post")
     */
    public function combateAction(Request $request, User $jugador,Deck $mideck, User $oponente, Deck $sudeck){
        $cartasOponente = $sudeck->getCardsContained();
        $cartasJugador = $mideck->getCardsContained();
        $cartasJugador_vivas = [];
        $cartasOponente_vivas = [];

//        $cartasOponente_array = [];

        $trampas = false;

        if($request->get('atacar')=== ''){
            $stat = $this->statAleatorio();
            $miFuerza = $this->sumaStatDeckAction($mideck, $stat);
            $suFuerza = $this->sumaStatDeckAction($sudeck, $stat);
            if($miFuerza > $suFuerza) {
                $ganador = $jugador;

            }else{
                $ganador = $oponente;
            }
            $batalla = $this->insertBatalla($jugador, $oponente, $ganador);
            if ($ganador === $jugador){
                $this->actualizarResultados($jugador, $oponente, $ganador, $batalla);
                $this->borrarMazoTemporal($sudeck);
                return $this->render('juego/victoria.html.twig',['jugador' => $jugador,
                    'oponente' => $oponente,
                    'cartasJugador' => $cartasJugador,
                    'cartasOponente' => $cartasOponente,
                    'stat' =>$stat,
                    'suValor' =>$suFuerza,
                    'miValor' =>$miFuerza]);
            }else{

                return $this->render('juego/derrota.html.twig',['jugador' => $jugador,
                    'oponente' => $oponente,
                    'cartasJugador' => $cartasJugador,
                    'cartasOponente' => $cartasOponente,
                    'stat' =>$stat,
                    'suValor' =>$suFuerza,
                    'miValor' =>$miFuerza]);
            }

        }
        if ($trampas){
            $this->addFlash('error', '¡Vaya! Parece que estás intentando hacer trampas :_(');
            return $this->redirectToRoute('portada');
        }


        return $this->render('juego/combate.html.twig', [
            'jugador' => $jugador,
            'oponente' => $oponente,
            'cartasJugador' => $cartasJugador,
            'cartasOponente' => $cartasOponente,
            'deckJugador' => $mideck,
            'deckOponente' => $sudeck
        ]);
    }
    //calcula un stat aleatorio
    public function statAleatorio(){
        $sr = mt_rand(0,3);
        return $sr;
    }
    // //suma los valores de un Deck en un stat
    public function sumaStatDeckAction(Deck $deck, $stat){

        $winner = null;



        switch ($stat){
            case 0:
                $miFuerza = 0;
                $suFuerza = 0;
                $misCartas = $deck->getCardsContained();
                foreach($misCartas as $carta){
                    $miFuerza = $miFuerza + $carta->getTypeCard()->getAtqA();
                }

                break;

            case 1:

                $miFuerza = 0;
                $suFuerza = 0;
                $misCartas = $deck->getCardsContained();
                foreach($misCartas as $carta){
                    $miFuerza = $miFuerza + $carta->getTypeCard()->getAtqB();
                }

                break;

            case 2:


                $miFuerza = 0;
                $suFuerza = 0;
                $misCartas = $deck->getCardsContained();
                foreach($misCartas as $carta){
                    $miFuerza = $miFuerza + $carta->getTypeCard()->getAtqC();
                }


            case 3:


                $miFuerza = 0;
                $suFuerza = 0;
                $misCartas = $deck->getCardsContained();
                foreach($misCartas as $carta){
                    $miFuerza = $miFuerza + $carta->getTypeCard()->getAtqD();
                }

                break;


        }

        return $miFuerza;
//
    }
    public function compararFuerzasDecks($f1, $f2){
//        if ($f1 > $f2){
////            $winner = $mideck->getDeckOwner();
////        }else{
////            $winner = $sudeck->getDeckOwner();
////        }
//
////        return $winner;
    }

    //crea un mazo "default" para el oponente con 4 cartas suyas aleatorias
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

    public function borrarMazoTemporal(Deck $deck){
        $this->getDoctrine()->getManager()->remove($deck);
        $this->getDoctrine()->getManager()->flush();
    }

    public function insertBatalla(User $jugador, User $oponente, User $ganador){
        $batalla = new Battle();
        $batalla->setBattleDate(new \DateTime());
        $batalla->setPlayerAttacker($jugador);
        $batalla->setPlayerDefender($oponente);
        $batalla->setWinner($ganador);
        $this->getDoctrine()->getManager()->persist($batalla);
        $this->getDoctrine()->getManager()->flush();

        return $batalla;
    }

    public function actualizarResultados(User $jugador, User $oponente, User $ganador, Battle $batalla){
        $dineroActual = $ganador->getCredits();
        $ganador->setCredits($dineroActual+10);
        $ganador->setReputation($ganador->getReputation()+5);
        $ataques = $jugador->getAtaques();
        $defensas = $oponente->getDefensas();
        $victorias = $ganador->getWin();
//        array_push($defensas, $batalla->getId());
//        array_push($ataques, $batalla->getId());
//        array_push($victorias, $batalla->getId());
        $this->getDoctrine()->getManager()->flush();
    }

    /**
     * @Route("/resultado/victoria", name="resultado_combate_victoria")
     */
    public function victoriaAction(){
        return $this->render('juego/victoria.html.twig');
    }

    /**
     * @Route("/resultado/derrota", name="resultado_combate_derrota")
     */
    public function derrotaAction(){
        return $this->render('juego/derrota.html.twig');
    }


}
