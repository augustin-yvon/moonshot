<?php

namespace App\Repository;

use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Document>
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }

    /**
     * @param int $user
     * @return array
     */

    // public function findDocumentsByUser($user)
    // {
    //     $classId = $this->createQueryBuilder('user_class_name')
    //     ->where('user_class_name.id = :userId')
    //     ->setParameter('userId', $user)
    //     ->getQuery()
    //         ->getFirstResult();

    //     return $this->createQueryBuilder('d')
    //         ->leftJoin('d.user', 'u')
    //         ->leftJoin('d.class', 'c')
    //         ->where('u.id = :userId OR c.id = :classId')
    //         ->setParameter('userId', $user)
    //         ->setParameter('classId', $classId)
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findDocumentsByUser($user)
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.class_id', 'c')
            ->addSelect('c')
            ->where('d.user_id = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

}
