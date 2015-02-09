<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Abstracts\ControllerFrontend;

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 08.02.2015
 * Time: 20:21
 */
class TestController extends ControllerFrontend
{
    public function indexAction($id)
    {
        return $this->render();
    }

    public function listAction()
    {
        $tests = [];

        return $this->render([
            'tests' => $tests,
            'pageName' => $this->t('Мои тесты'),
            'pageSubHead' => $this->renderPartial('_addTest'),
        ]);
    }

    public function createAction($step, $type = null)
    {
        return $this->render([
            'pageName' => $this->t('Новый тест'),
            'step' => $step,
        ]);
    }

    // Ajax

    public function typeFormAction()
    {
        $this->validateAjax();

        \Test::show($_POST);
    }

    // END Ajax
} 