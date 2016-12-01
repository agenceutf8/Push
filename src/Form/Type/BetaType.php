<?php

/**
 * Created by PhpStorm.
 * User: POL
 * Date: 29/11/2016
 * Time: 22:28
 */

namespace Push\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mail', 'mail');
    }

    public function getName()
    {
        return 'beta';
    }

}