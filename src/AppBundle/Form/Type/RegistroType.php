<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

       $builder
          ->add('login', null, [
              'attr' =>['class'=> 'input_element_cp'],
              'required' => true
              ])
           ->add('nickname', null, [
               'attr' =>['class'=> 'input_element_cp'],
               'required' => true
           ])
           ->add('password',PasswordType::class, [
               'attr' =>['class' => 'input_element_cp'],
               'required' => true
           ]);
        if ($options['es_admin']){
            $builder
                ->add('credits', null, [
                    'label' => 'Créditos',
                    'required' => false
                ])
                ->add('reputation', null, [
                    'label' => 'Reputación',
                    'required' => false
                ]);

        }



    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
          'data_class' => User::class,
           'es_admin' => false
       ]);
    }
}