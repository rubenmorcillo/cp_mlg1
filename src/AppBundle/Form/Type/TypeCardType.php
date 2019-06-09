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
               'label'=> 'Nombre',
               'required' => true
           ])
           ->add('atq_a', null, [
               'label' => 'Ataque',
               'required' => true
           ])
           ->add('atq_b', null, [
               'label' => 'Inteligencia',
               'required' => true
           ])
           ->add('atq_c', null, [
               'label' => 'Armadura',
               'required' => true
           ])
           ->add('atq_d', null, [
               'label' => 'Velocidad',
               'required' => true
           ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
          'data_class' => TypeCard::class
       ]);
    }
}