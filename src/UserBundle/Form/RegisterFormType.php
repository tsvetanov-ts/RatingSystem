<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'email', array(
                'label' => 'Email Address',
                'attr'    => array('class' => 'C-3PO')
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Form\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'user_register';
    }
} 