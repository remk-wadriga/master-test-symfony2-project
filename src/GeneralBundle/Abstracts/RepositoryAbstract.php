<?php
/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 03.10.14
 * Time: 18:41
 */

namespace GeneralBundle\Abstracts;

use Doctrine\ORM\EntityRepository;

class RepositoryAbstract extends EntityRepository
{
    /**
     * @param string $modelName
     * @return mixed
     */
    protected function model($modelName)
    {
        return $this->getEntityManager()->getRepository('GeneralBundle:'.$modelName);
    }
}