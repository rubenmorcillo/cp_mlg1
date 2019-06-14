<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Deck;
use AppBundle\Form\Listener\AddStateFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DeckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deckName', null,[
               'label' => 'Nombre'
            ])
            ->add('deckOwner',null,[
                'label' => 'propietario',
                'disabled' => true
            ]);


        //Añadimos un EventListener que actualizará el campo cardsContained para
        //que sus opciones correspondan con el usuario seleccionado
        //Este Listener tenemos que crearlo (AppBundle\Form\Listener\AddStateFieldSubsriber)
        $builder->addEventSubscriber(new AddStateFieldSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver ->setDefaults(['data_class' => Deck::class]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_deck_type';
    }
}
