<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAdminType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
          ->add('nickname', null, [
              'label' => 'Nick',
              'required' => true
              ])
           ->add('credits', null, [
             'label' => 'Créditos',
               'required' => false
           ])
           ->add('reputation', null, [
               'label' => "Reputación",
               'required' => false
           ])
           ->add('esAdmin', null,[
               'label' => 'Privilegios Administrador'
           ]);





    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
          'data_class' => User::class,
       ]);
    }
}