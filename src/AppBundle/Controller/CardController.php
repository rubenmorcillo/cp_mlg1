<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Card;
use AppBundle\Entity\User;
use AppBundle\Repository\CardRepository;
use AppBundle\Repository\TypeCardRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends Controller
{

    /**
     * @Route("/mui/{id}", name="interfazJuego", requirements={"id": "\d+"})
     */
    public function cardListAction(CardRepository $cardRepository, User $usuario){
        $cartas = $usuario->getCards();
        return $this->render('user/InterfazUsuario.html.twig', [
            'usuario' => $usuario,
            'cards' => $cartas
        ]);

    }
    /**
     * @Route("/cu/{id}", name="cartas_lista_user", requirements={"id": "\d+"})
     */
    public function cardListUserAction(CardRepository $cr, User $usuario){
        if($usuario <> $this->getUser()){
          $usuario = $this->getUser();
        }
        $cartas = $usuario->getCards();
        return $this->render('user/coleccion.html.twig', [
            'usuario' => $usuario,
            'cards' => $cartas
        ]);

    }

    /**
     * @Route("/tienda/{id}", name="tienda", requirements={"id": "\d+"})
     */
    public function tiendaAction(CardRepository $cardRepository, User $usuario){
        return $this->render('market/tienda.html.twig', [
            'usuario' => $usuario,
        ]);

    }

    /**
     * @Route("/tienda/cc/{id}", name="tienda_carta_comprar_una", requirements={"id": "\d+"})
     */
    public function comprarCarta(Request $request,TypeCardRepository $tcr,UserRepository $ur, User $user){
        $precio = null;
        $logeado = $this->getUser();
        $logeado = $ur->findOneBy(['id' => $logeado]);
        if($user->getNickname() <> $logeado->getNickname()){
            $this->addFlash('exito', 'redirigido a tu tienda, bribón ;)');
            return $this->redirectToRoute('tienda_carta_comprar_una', ['id' => $logeado->getId()]);
        }

        if($request->get('c10') === ''){
            /*Comprobar si el usuario tiene dinero suficiente*/
            $precio = 10;
            $dinero_user = $user -> getCredits();
            if ( $dinero_user < $precio){
                $this->addFlash('error', 'No tienes créditos suficientes :(');

                return $this->redirectToRoute('tienda',['id' => $user->getId()]);
            }

            $tc = $tcr->find(['id' => mt_rand(1,25)]);
            $carta = new Card();
            $carta->setCardOwner($user);
            $carta->setTypeCard($tc);
            $user->setCredits($dinero_user - $precio);
            try{
                $this->getDoctrine()->getManager()->persist($carta);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'has adquirido una nueva carta');
                return $this->redirectToRoute('tienda',['id' => $user->getId()]);
            }catch(\Exception $e){
                $this->addFlash('error', 'no se ha podido completar la compra');
            }
        }
        return $this->render('market/formComprarCartas.html.twig',[
            'usuario' => $user,
            'precio' => $precio
        ]);
    }
    /**
     * @Route("/redireccion", name="tienda_carta_comprar_pack", requirements={"id": "\d+"})
     */
    public function comprarPack(User $user){
        return $this->render('default/index.html.twig');
    }
}

