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

    public function findDocumentsByUser($user)
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.class_name', 'c')
            ->addSelect('c')
            ->where('d.user_id = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
