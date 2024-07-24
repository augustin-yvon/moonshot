<?php

namespace App\Repository;

use App\Entity\ClassName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassName>
 */
class ClassNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassName::class);
    }

       /**
        * @return ClassName[] Returns an array of ClassName objects
        */
       public function findByUser($user): array
       {
           return $this->createQueryBuilder('c')
               ->Where('c.users = :val')
               ->setParameter('val', $user)
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?ClassName
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
