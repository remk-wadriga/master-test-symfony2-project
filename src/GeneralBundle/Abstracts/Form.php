<?php

namespace GeneralBundle\Abstracts;

use Symfony\Component\Form\AbstractType;

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 07.02.2015
 * Time: 20:42
 */
class Form extends AbstractType
{
    public function getName()
    {
        $classParts = explode('\\', get_class($this));
        return strtolower(str_replace('Form', '', end($classParts)));
    }
}