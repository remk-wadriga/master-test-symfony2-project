<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Abstracts\ControllerFrontend;
use GeneralBundle\Forms\AccountForm;

/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 07.02.2015
 * Time: 21:17
 */
class UserController extends ControllerFrontend
{
    public function indexAction()
    {
        $user = $this->getUser();
        $accountForm = $this->createForm(new AccountForm(), $user);

        if($this->isPostRequest() === true){
            $accountForm->submit($this->getRequest());

            if($accountForm->isValid() === true){
                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();
            }else{
                $this->flashError($accountForm);
            }
        }

        return $this->render([
            'accountForm' => $accountForm->createView(),
        ]);
    }
}