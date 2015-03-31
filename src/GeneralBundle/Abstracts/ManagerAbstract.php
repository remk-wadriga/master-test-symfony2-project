<?php
/**
 * Created by PhpStorm.
 * User: rem
 * Date: 14.10.14
 * Time: 14:11
 */

namespace GeneralBundle\Abstracts;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Translation\IdentityTranslator as Translator;
use Doctrine\Bundle\DoctrineBundle\Registry;

abstract class ManagerAbstract
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \GeneralBundle\Abstracts\RepositoryAbstract
     */
    protected $repository;

    /**
     * @var \Symfony\Component\Translation\IdentityTranslator
     */
    protected $translator;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    protected $errors = [];

    public function __construct(Registry $doctrine, Translator $translator, Container $container)
    {
        $this->em = $doctrine->getManager();
        $this->translator = $translator;
        $this->container = $container;
    }

    public function init(\GeneralBundle\Abstracts\RepositoryAbstract $repository)
    {
        $this->repository = $repository;
        $this->repository->setContainer($this->container);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $criteria
     * @param array $orderBy
     * @return mixed
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->repository->findOneBy($criteria, $orderBy);
    }

    /**
     * @param string $repositoryName
     * @return mixed
     */
    protected function model($repositoryName)
    {
        return $this->em->getRepository('GeneralBundle:'.$repositoryName);
    }

    protected function addError($text)
    {
        $this->errors[] = $text;
    }

    public function persist(\GeneralBundle\Abstracts\EntityAbstract $entity)
    {
        $this->em->persist($entity);
    }

    public function flush()
    {
       $this->em->flush();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return implode('; ', $this->getErrors());
    }

    public function hasErrors()
    {
        return count($this->errors) === 0;
    }

    private function getRepositoryName($repositoryName = null)
    {
        if($repositoryName === null){
            $name = explode('\\', get_class($this));

        }

    }
}