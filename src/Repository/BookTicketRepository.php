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
    /*
    public function findByPerformance($value): ?BookTicket
    {
      return $this->createQueryBuilder('fc')
            ->andWhere('fc.category = :category')
            ->setParameter('category', $category)
            ->select('SUM(fc.numberPrinted) as fortunesPrinted')
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }

    */
}
