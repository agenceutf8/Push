<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 30/11/2016
 * Time: 21:17
 */

namespace Push\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('password', 'repeated', array(
                'type'              => 'password',
                'invalid_message'   => 'Le mot de passe doit correspondre.',
                'options'           => array('required' => true),
                'first_options'     => array('label' => 'Mot de passe'),
                'second_options'    => array('label' => 'Répéter votre mot de passe')
            ))
            ->add('mail', 'email')
            ->add('role', 'choice', array(
                'choices'   => array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'User')
            ));
    }

    public function getName()
    {
        return 'user';
    }
}