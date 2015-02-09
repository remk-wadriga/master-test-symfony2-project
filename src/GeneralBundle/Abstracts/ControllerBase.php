<?php

namespace GeneralBundle\Abstracts;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 18.01.2015
 * Time: 21:03
 */
abstract class ControllerBase extends Controller
{
    /**
     * @param null $view
     * @param array $parameters
     * @param Response $response
     * @return Response
     */
    public function render($view = null, array $parameters = array(), Response $response = null)
    {
        if(is_array($view)){
            $response = $parameters ? $parameters : null;
            $parameters = $view;
            $view = null;
        }

        return parent::render($this->parseViewString($view), $parameters, $response);
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return string
     */
    public function renderPartial($view, $parameters = [])
    {
        return parent::renderView($this->parseViewString($view), $parameters);
    }

    /**
     * @param string $modelName
     * @return null|object
     */
    protected function model($modelName)
    {
        $manager = null;

        switch($modelName){
            case 'User':
                $manager = $this->get('user_manager');
                break;
            case 'Answer':
                $manager = $this->get('answer_manager');
                break;
            case 'Formula':
                $manager = $this->get('formula_manager');
                break;
            case 'Question':
                $manager = $this->get('question_manager');
                break;
            case 'Test':
                $manager = $this->get('test_manager');
                break;
            case 'UserTestResult':
                $manager = $this->get('user_test_result_manager');
                break;
        }

        if($manager){
            $manager->init($this->getDoctrine()->getManager()->getRepository('GeneralBundle:'.$modelName));
        }

        return $manager;
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function param($name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * @param $json
     * @param null $view
     * @param array $params
     * @return Response
     */
    public function ajax($json, $view = null, $params = [])
    {
        if(is_string($json)){
            if(is_array($view)){
                $params = $view;
                $view = $json;
                $json = [];
            }else{
                $message = $json;
                $json = [
                    'message' => $this->t($message)
                ];
            }
        }

        if(!$json)
            $json = [];

        if(!isset($json['message']))
            $json['message'] = '';
        if(!isset($json['error']))
            $json['error'] = '';
        if(!isset($json['html']))
            $json['html'] = '';

        if($view !== null && !$json['html']){
            $json['html'] = $this->renderView($this->parseViewString($view), $params);
        }

        return new Response(json_encode($json) , 200 , ['Content-Type' => 'application/json']);
    }

    /**
     * @param array|string $json
     * @return Response
     */
    public function ajaxError($json)
    {
        if(is_string($json)){
            $error = $json;
            $json = [
                'error' => $this->parseError($error)
            ];
        }

        return $this->ajax($json);
    }

    public function t($string, $params = [])
    {
        return $this->get('translator')->trans($string, $params);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return parent::getRequest();
    }

    protected function parseViewString($view)
    {
        if(!$view || strpos($view, ':') === false){
            $matches = array();
            $controller = $this->getRequest()->attributes->get('_controller');
            preg_match('/(.*)\\\Controller\\\(.*)Controller::(.*)Action/', $controller, $matches);

            $bundleName = $matches[1];
            $controller = $matches[2];
            $action = $matches[3];

            $view = !$view ? $bundleName.':'.$controller.':'.$action : $bundleName.':'.$controller.':'.$view;
        }

        if(strpos($view, '.html.twig') === false)
            $view .= '.html.twig';

        return $view;
    }

    protected function flashWarning($warning)
    {
        $this->get('session')->getFlashBag()->add('warning', $this->parseError($warning));
    }

    protected function flashError($error)
    {
        $this->get('session')->getFlashBag()->add('error', $this->parseError($error));
    }

    protected function flashMessage($message)
    {
        $this->get('session')->getFlashBag()->add('message', $this->t($message));
    }

    protected function flashSuccess($success)
    {
        $this->get('session')->getFlashBag()->add('success', $this->t($success));
    }

    protected function parseError($error)
    {
        if(!is_string($error) && $error instanceof Form){
            $error = (string)$error->getErrors(true, false);
        }

        return $this->t(trim(str_replace('ERROR:', '', $error)));
    }

    protected function isPostRequest()
    {
        return $this->getRequest()->getMethod() === 'POST';
    }

    protected function isAjaxRequest()
    {
        return $this->getRequest()->isXmlHttpRequest();
    }

    protected function validateAjax()
    {
        if($this->isAjaxRequest() === false){
            throw $this->createNotFoundException();
        }
    }

    /**
     * @param $name
     * @param null $value
     * @return mixed|string
     */
    protected function session($name, $value = null)
    {
        if(!$this->getSession())
            return '';

        if(!$value)
            return $this->getSession()->get($name);
        else
            return $this->getSession()->set($name, $value);
    }

    /**
     * @return null|\Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected function getSession()
    {
        return $this->getRequest()->getSession();
    }
} 