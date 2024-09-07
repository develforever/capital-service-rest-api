<?php

namespace App\Repository;

use App\Entity\LoanEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LoanEntity>
 */
class LoanEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoanEntity::class);
    }

    //    /**
    //     * @return LoanEntity[] Returns an array of LoanEntity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?LoanEntity
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * @return LoanEntity[]
     */
    public function findAllGreaterThanPrice(bool $all = false): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT l.id, l.createdAt, l.amount, sum(ls.interest) as interest_sum
            FROM App\Entity\LoanEntity l
            left join l.loanSchedules ls
            where l.deletedAt is null
            group by l.id
            order by sum(ls.interest) desc'
        );

        return $query->getResult();
    }
}
