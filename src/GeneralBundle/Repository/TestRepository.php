<?php

namespace GeneralBundle\Repository;

use GeneralBundle\Abstracts\RepositoryAbstract;

/**
 * TestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TestRepository extends RepositoryAbstract
{
    /**
     * @param int $userId
     * @return \GeneralBundle\Entity\Test[]
     */
    public function getUserTests($userId, $offset = 0)
    {
        return $this->getQB()
                    ->where('t.owner_id = :user_id')
                    ->setParameter('user_id', $userId)
                    ->setFirstResult($offset)
                    ->setMaxResults($this->container->getParameter('test_list_limit'))
                    ->getQuery()
                    ->getResult();

        /*$qb = $this->createQueryBuilder('t');
            $qb->select([
                't.id',
                't.type',
                't.owner_id AS ownerId',
                't.name',
                't.description',
                't.date_creation AS dateCreation',
                'u.username AS ownerName',
            ])
            ->leftJoin('t.author', 'u');

        return $qb->getQuery()->getResult();*/
    }
}
