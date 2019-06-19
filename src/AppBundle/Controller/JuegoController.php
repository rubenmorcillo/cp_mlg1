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
     * @Route("/Combat/{jugador}/{mideck}/{oponente}/{sudeck}", name="game_combate")
     */
    public function combateAction(Request $request, User $jugador,Deck $mideck, User $oponente, Deck $sudeck){
        $cartasOponente = $sudeck->getCardsContained();
        $cartasJugador = $mideck->getCardsContained();
        $cartasJugador_vivas = [];
        $cartasOponente_vivas = [];

        //convirtiendo a array normal para que no falle método "in_array"
        $cartasJugador_array = [];
        for($i=0;$i<count($cartasJugador);$i++){
            $elId = $cartasJugador[$i]->getId();
            array_push($cartasJugador_array, $elId);
        }
//        $cartasOponente_array = [];

        $trampas = false;


        if($request->get('atacar')=== ''){

            //Compruebo que ha elegido
            if ($request->get('seleccionada') === ''){

            }else{
                //el jugador ha seleccionado una carta
                $cJug = $request->get('seleccionada'); //recojo eleccion jugador
                if ($cJug <> null){
                    //compruebo q ha elegido una de su mazo activo
                    for($i=0;$i<count($cartasJugador);$i++){
                        if(!in_array($cJug,$cartasJugador_array)){
                            $trampas = true;
                        }
                    }
                }else{
                    return $this->render('juego/combate.html.twig', [
                        'jugador' => $jugador,
                        'oponente' => $oponente,
                        'cartasJugador' => $cartasJugador,
                        'cartasOponente' => $cartasOponente,
                        'deckJugador' => $mideck,
                        'deckOponente' => $sudeck
                    ]);
                }

                $cOp = $cartasOponente[mt_rand(0,count($cartasOponente)-1)]; //eleccion aleatoria del oponente

                $this->addFlash('exito', 'atacando con '.$cJug.'...');
                $this->addFlash('exito', 'el oponente ha elegido'.$cOp);
            }


        }
        else{
            $cartasJugador_vivas = $cartasJugador;
            $cartasOponente_vivas = $cartasOponente;
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

    public function enfrentarCartasAction($cJug, $cOp){
        //elijo un stat random
        $sr = mt_rand(0,3);


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



}
