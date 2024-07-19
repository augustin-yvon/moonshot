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

    public function findDocumentsByUser($user,$classes)
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.class_id', 'c')
            ->addSelect('c')
            ->where('d.user_id = :user')
            ->orWhere('c.id in (:classes)')
            ->setParameter('user', $user)
            ->setParameter('classes', $classes)
            ->getQuery()
            ->getResult();
    }
}
