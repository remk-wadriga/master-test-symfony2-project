<?php

namespace GeneralBundle\Manager;

use GeneralBundle\Abstracts\ManagerAbstract;
use GeneralBundle\Entity\Test;

/**
 * Created by PhpStorm.
 * User: rem
 * Date: 14.10.14
 * Time: 14:42
 *
 * @property \GeneralBundle\Repository\TestRepository $repository
 */
class TestManager extends ManagerAbstract
{
    /**
     * @param integer $testId
     * @param integer $number
     * @return null|\GeneralBundle\Entity\Question
     */
    public function getQuestionByNumber($testId, $number = 1)
    {
        return $this->model('Question')->findOneBy(['test' => $testId, 'num' => $number]);
    }

    public function getUserTests($userId)
    {
        return $this->repository->getUserTests($userId);
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }
}