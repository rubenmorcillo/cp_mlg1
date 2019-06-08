<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\TypeCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeCardType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('name', null, [
               'label'=> 'Nombre'
           ])
           ->add('atq_a', null, [
               'label' => 'Ataque'
           ])
           ->add('atq_b', null, [
               'label' => 'Inteligencia'
           ])
           ->add('atq_c', null, [
               'label' => 'Armadura'
           ])
           ->add('atq_d', null, [
               'label' => 'Velocidad'
           ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
          'data_class' => TypeCard::class
       ]);
    }
}