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

    public function findByFilter()
    {
        $where = [];

        $range_price = isset($_GET['range_price']) ? $_GET['range_price'] : false;
        switch($range_price) {
            case '0_1500':
                $where[] = 'u.price >= 0';
                $where[] = 'u.price <= 1500';
                break;
            case '1500_3000':
                $where[] = 'u.price >= 1500';
                $where[] = 'u.price <= 3000';
                break;
            case '3000_9000':
                $where[] = 'u.price >= 3000';
                $where[] = 'u.price <= 9000';
                break;
            case '9000':
                $where[] = 'u.price >= 9000';
                break;
        }
        
        $range_km = isset($_GET['range_km']) ? $_GET['range_km'] : false;
        switch($range_km) {
            case '0_15000':
                $where[] = 'u.kilometers < 15000';
                break;
            case '15000_40000':
                $where[] = 'u.kilometers >= 15000';
                $where[] = 'u.kilometers < 40000';
                break;
            case '40000_90000':
                $where[] = 'u.kilometers >= 40000';
                $where[] = 'u.kilometers < 90000';
                break;
            case '90000':
                $where[] = 'u.kilometers >= 90000';
                break;
        }
        
        $range_year = isset($_GET['range_year']) ? $_GET['range_year'] : false;
        switch($range_year) {
            case '2000':
                $where[] = 'u.year < 2000';
                break;
            case '2000_2007':
                $where[] = 'u.year >= 2000';
                $where[] = 'u.year < 2008';
                break;
            case '2008_2014':
                $where[] = 'u.year >= 2008';
                $where[] = 'u.year < 2015';
                break;
            case '2015':
                $where[] = 'u.year >= 2015';
                break;
        }

        //test if string (numbers() ?)
        /*$min_price = @intval($_GET['min_price']);
        if ( $min_price >= 0 ) {
            $where[] = 'u.price >= '.$min_price;
        }
        $max_price = @intval($_GET['max_price']);
        if ( !empty($max_price) ) {
            $where[] = 'u.price <= '.$max_price;
        }
        $price = @intval($_GET['price']);
        if ( !empty($price) && empty($min_price) && empty($max_price) ) {
            $where[] = 'u.price = '.$price;
        }
        $model = @trim($_GET['model']);
        if ( !empty($model) ) {
            $where[] = 'u.model LIKE \'%'.$_GET['model'].'%\'';
        }*/

        //exit(var_export(implode(' AND ', $where), 1));
        if ( !empty($where) ) {
            return $this->createQueryBuilder('u')
            ->select('u.id', 'u.model', 'u.kilometers', 'u.year', 'u.price', 'u.pictureFilename')
            ->andWhere(implode(' AND ', $where))
            //->setParameter('val', $_GET['year'])
            ->getQuery()
            ->getResult();
        }
        else {
            return $this->findAll();
        }
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
