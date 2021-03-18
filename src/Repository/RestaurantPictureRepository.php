<?php

namespace App\Repository;

use App\Entity\RestaurantPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RestaurantPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantPicture[]    findAll()
 * @method RestaurantPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantPicture::class);
    }

    // /**
    //  * @return RestaurantPicture[] Returns an array of RestaurantPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RestaurantPicture
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
