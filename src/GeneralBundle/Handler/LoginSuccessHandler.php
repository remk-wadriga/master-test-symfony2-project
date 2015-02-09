<?php

namespace GeneralBundle\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Created by PhpStorm.
 * User: rem
 * Date: 09.09.14
 * Time: 15:34
 *
 * Login listener
 */
class LoginSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /**
     * @param SecurityContext $securityContext
     * @param Doctrine $doctrine
     * @param Router $router
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine, Router $router)
    {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getManager();
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        $user->setDateLastLogin(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();

        return new RedirectResponse('account');
    }
} 