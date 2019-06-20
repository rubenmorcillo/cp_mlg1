<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Card;
use AppBundle\Entity\TypeCard;
use AppBundle\Form\Type\TypeCardType;
use AppBundle\Repository\TypeCardRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TypeCardController extends Controller
{
    /**
     * @Route("/card", name="card_list")
     */
    public function typeCardListarAction(TypeCardRepository $typeCardRepository)
    {

        $todasCartas = $typeCardRepository->findAll();
        return $this->render('typeCard/list2.html.twig', [
            'cards' => $todasCartas,
            'usuario' => null
        ]);
    }

    /**
     * @Route("/adminMode/card", name="admin_card_list")
     */
    public function typeCardAdminListarAction(TypeCardRepository $typeCardRepository)
    {

        $todasCartas = $typeCardRepository->findAll();
        return $this->render('typeCard/listaAdmin.html.twig', [
            'cards' => $todasCartas,
            'usuario' => null
        ]);
    }


    /**
     * @Route("/card/{id}", name="card_edit", requirements={"id":"\d+"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function formTypeCardAction(Request $request, TypeCard $typeCard){
        $user = $this->getUser();
        $form = $this->createForm(TypeCardType::class, $typeCard);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('typeCard/form.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }



}

