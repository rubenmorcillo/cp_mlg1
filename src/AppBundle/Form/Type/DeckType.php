<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Deck;
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
            ->add('cardsContained', null, [
                'label' => 'Elige tus cartas',
                'required'=> false,
//                'data' => $options['cardsContained']
            ]);
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
