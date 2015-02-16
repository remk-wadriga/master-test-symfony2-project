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
class TestTypeForm extends Form
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var \GeneralBundle\Entity\Test
         */
        $test = isset($options['data']) ? $options['data'] : null;

        $builder->add('type', 'choice', [
            'label' => 'Логин',
            'required' => true,
            'attr' => [
                'placeholder' => 'Логин',
            ],
            'choices' => $test !== null ? $test->getTypesItems() : [],
        ]);
        /*$builder->add('password', 'repeated', [
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
        ]);*/
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'GeneralBundle\Entity\User'
        ]);
    }
}