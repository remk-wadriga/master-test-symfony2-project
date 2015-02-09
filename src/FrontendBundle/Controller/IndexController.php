<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Abstracts\ControllerFrontend;
use GeneralBundle\Entity\User;
use GeneralBundle\Forms\RegistrationForm;
use Symfony\Component\Security\Core\SecurityContext;

class IndexController extends ControllerFrontend
{
    public function indexAction()
    {
        return $this->render();
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }else{
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render([
            'lastUsername' => $this->session(SecurityContext::LAST_USERNAME),
            'error' => $error,
        ]);
    }

    public function registrationAction()
    {
        $user = new User();
        $registrationForm = $this->createForm(new RegistrationForm(), $user);

        if($this->isPostRequest() === true){
            $registrationForm->submit($this->getRequest());

            if($registrationForm->isValid() === true){
                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('user_home'));
            }else{
                $this->flashError($registrationForm);
            }
        }

        return $this->render([
            'registrationForm' => $registrationForm->createView(),
        ]);
    }
}