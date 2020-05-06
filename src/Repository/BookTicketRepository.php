<?php

namespace App\Repository;

use App\Entity\BookTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookTicket[]    findAll()
 * @method BookTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookTicket::class);
    }

    // /**
    //  * @return BookTicket[] Returns an array of BookTicket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookTicket
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
