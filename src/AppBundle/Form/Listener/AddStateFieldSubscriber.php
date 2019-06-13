<?php


namespace AppBundle\Form\Listener;


use AppBundle\Entity\Card;
use AppBundle\Entity\Deck;
use AppBundle\Repository\CardRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddStateFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array (
            FormEvents::PRE_SET_DATA => 'preSetData' , //nuevo evento escuchado
            FormEvents::PRE_SUBMIT => 'preSubmit',
            );
    }

    /**
     * Este evento se ejecuta al momento de crear el formulario
     * o al llamar al métofo $form->setData($user),
     * y nos sirve para obtener los datos iniciales del objeto asociado al form,
     * ya que, por ejemplo, si el objeto viene de la base de datos y contiene ya un pais establecido lo idea es que
     * el campo state se cargue inicialmente con los estados de dicho pais.
     */
    public function preSetData(FormEvent $event)
    {
        $deck = $event->getData();

        $user = ($deck and $deck->getDeckOwner()) ? $deck->getDeckOwner() : null;

        $this->addField($event->getForm(), $user);

    }


    /**
     * Cuando el usuario llene los datos del formulario y haga submit, este método se ejecuta
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        //data es un array con los valores establecidos por el usuario en el formulario

        //como $data contiene el usuario propietario al enviar el formulario,
        //usamos el valor de la posicion $data['deckOwner'] para filtrar el sql de los estados
        $this->addField($event->getForm(), $data['deckOwner']);
    }

    private function addField(\Symfony\Component\Form\FormInterface $form, $deckOwner)
    {

        //actualizamos el campo state, pasándole el country al queryBuilder para filtrar
        $form->add('cardsContained', null, [
            'query_builder' => function(EntityRepository $cardRepository) use ($deckOwner){
            return $cardRepository->createQueryBuilder('c')
                ->where('c.cardOwner = :usuario')
                ->setParameter('usuario', $deckOwner);
            }
        ]);
    }


}