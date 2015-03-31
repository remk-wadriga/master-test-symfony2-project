<?php

namespace GeneralBundle\Forms;

use GeneralBundle\Abstracts\Form;
use GeneralBundle\Entity\Test;
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
        $test = isset($options['data']) && $options['data'] instanceof Test ? $options['data'] : null;

        $builder->add('type', 'choice', [
            'label' => 'Логин',
            'required' => true,
            'attr' => [
                'placeholder' => 'Логин',
            ],
            'choices' => $test !== null ? $test->getTypesItems() : [],
        ]);
        $builder->add('name', 'text', [
            'label' => 'Название',
            'required' => true,
            'attr' => [
                'placeholder' => 'Название',
            ]
        ]);
        $builder->add('description', 'textarea', [
            'label' => 'Описание',
            'required' => true,
            'attr' => [
                'placeholder' => 'Описание',
            ]
        ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'GeneralBundle\Entity\Test'
        ]);
    }
}