<?php
/**
 * Created by PhpStorm.
 * User: rem
 * Date: 14.10.14
 * Time: 14:11
 */

namespace GeneralBundle\Abstracts;

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
     * @var \Symfony\Component\Translation\Translator
     */
    protected $translator;

    protected $errors = [];

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine, \Symfony\Component\Translation\Translator $translator)
    {
        $this->em = $doctrine->getManager();
        $this->translator = $translator;
    }

    public function init(\GeneralBundle\Abstracts\RepositoryAbstract $repository)
    {
        $this->repository = $repository;
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
}