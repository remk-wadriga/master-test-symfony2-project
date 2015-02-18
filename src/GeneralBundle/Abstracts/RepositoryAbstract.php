<?php
/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 03.10.14
 * Time: 18:41
 */

namespace GeneralBundle\Abstracts;

use Doctrine\ORM\EntityRepository;

abstract class RepositoryAbstract extends EntityRepository
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param string $modelName
     * @return mixed
     */
    protected function model($modelName)
    {
        return $this->getEntityManager()->getRepository('GeneralBundle:'.$modelName);
    }

    /**
     * @param string $alias
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getQB($alias = 't')
    {
        return $this->createQueryBuilder($alias);
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container)
    {
        $this->container = $container;
    }
}