<?php

namespace AppBundle\Controller;
use AppBundle\Entity\TypeCard;
use AppBundle\Form\Type\TypeCardType;
use AppBundle\Repository\TypeCardRepository;


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
        return $this->render('typeCard/list.html.twig', [
            'cards' => $todasCartas
        ]);
    }
    /**
     * @Route("/card/{id}", name="card_edit", requirements={"id":"\d+"})
     */
    public function formTypeCardAction(Request $request, TypeCard $typeCard){
        $form = $this->createForm(TypeCardType::class, $typeCard);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('typeCard/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

 #   /**
#     * @Route("/card/nueva", name="card_nueva")
#     */
 #   public function formNuevoTypeCardAction(Request $request){
  #     $typeCard = new TypeCard();
#
 #       $this->getDoctrine()->getManager()->persist($typeCard);
#
 #       return $this->formTypeCardAction($request, $typeCard);
  #  }

}

