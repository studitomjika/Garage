<?php

namespace App\Repository;

use App\Entity\UsedCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsedCar>
 *
 * @method UsedCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsedCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsedCar[]    findAll()
 * @method UsedCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsedCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsedCar::class);
    }

    public function findByQuery(string $query): array
    {
        if (empty($query)) {
            return [];
        }
        
        return $this->createQueryBuilder('b')
            ->andWhere('b.model LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
    //     * @return UsedCar[] Returns an array of UsedCar objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UsedCar
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
