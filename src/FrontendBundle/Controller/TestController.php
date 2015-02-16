<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Abstracts\ControllerFrontend;
use GeneralBundle\Entity\Test;
use GeneralBundle\Forms\TestTypeForm;

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

    public function newTestTypeAction()
    {
        $test = new Test();
        $test->setAuthor($this->getUser());
        $testTypeForm = $this->createForm(new TestTypeForm(), $test);

        if($this->isPostRequest()){
            $testTypeForm->submit($this->getRequest());
            if($testTypeForm->isValid()){
                $em = $this->getDoctrine()->getManager();

                $em->persist($test);
                $em->flush();

                return $this->redirect($this->generateUrl('test_add_question', ['id' => $test->getId(), 'questionId' => 1]));
            }else{
                $this->flashError($testTypeForm);
            }
        }

        return $this->render([
            'testTypeForm' => $testTypeForm->createView(),
        ]);
    }

    public function addQuestionAction($id, $questionId)
    {
        return $this->render([

        ]);
    }

    // Ajax



    // END Ajax
} 