<?php

namespace Uevf\UserBundle\Repository;

/**
 * AccountRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccountRepository extends \Doctrine\ORM\EntityRepository
{
    public function countUser(){
         $qb = $this->createQueryBuilder('a');
         return $qb->select('COUNT(a)')
            ->where('a.roles LIKE :arg')
            ->setParameter('arg','%ROLE_USER%')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
