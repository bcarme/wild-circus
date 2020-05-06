<?php

namespace App\Repository;

use App\Entity\ModalBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ModalBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModalBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModalBook[]    findAll()
 * @method ModalBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModalBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModalBook::class);
    }

    // /**
    //  * @return ModalBook[] Returns an array of ModalBook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModalBook
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
