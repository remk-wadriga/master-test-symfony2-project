<?php

namespace GeneralBundle\Forms;

use GeneralBundle\Abstracts\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 07.02.2015
 * Time: 21:01
 */
class RegistrationForm extends Form
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', [
            'label' => 'Логин',
            'required' => true,
            'attr' => [
                'placeholder' => 'Логин',
            ]
        ]);
        $builder->add('email', 'email', [
            'label' => 'Электронная почта',
            'required' => true,
            'attr' => [
                'placeholder' => 'Электронная почта',
            ]
        ]);
        $builder->add('firstName', 'text', [
            'label' => 'Имя',
            'required' => false,
            'attr' => [
                'placeholder' => 'Имя',
            ]
        ]);
        $builder->add('lastName', 'text', [
            'label' => 'Фамилия',
            'required' => false,
            'attr' => [
                'placeholder' => 'Фамилия',
            ]
        ]);
        $builder->add('password', 'repeated', [
            'type' => 'password',
            'invalid_message' => 'Введённые пароли не совпадают',
            'required' => true,
            'first_options'  => [
                'attr' => [
                    'placeholder' => 'Пароль'
                ]
            ],
            'second_options' => [
                'attr' => [
                    'placeholder' => 'Повторите Пароль'
                ]
            ],
        ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'GeneralBundle\Entity\User'
        ]);
    }
}