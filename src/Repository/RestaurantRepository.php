<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }



    public function store($restaurant){
        $entityManager = $this->getEntityManager();
        $entityManager->persist($restaurant);
        $entityManager->flush();


    }



    public function  edit_restaurant($restaurant)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();
    }
    public function deleterestaurant($restaurant)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($restaurant);
        $entityManager->flush();
    }

    /**
     * Afficher les 3 derniers restaurants créés
     * @return int|mixed|string
     */
    public function listeTroixdernierRestaurant()
    {

        return $this->createQueryBuilder('r')
            ->orderBy('r.created_at', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Restaurant $restaurant
     * @return int|mixed|string
     */
    public function moyenne()
    {
        return $this->createQueryBuilder('res')
            ->join('App\Entity\Review','rev')
            ->where('rev.restaurant_id=res.id ')
            ->select('res as restaurant,AVG(rev.rating) as moyenne')
            ->groupBy('res.id')
            ->getQuery()
            ->getResult();
    }
    /**
     * @param Restaurant $restaurant
     * @return int|mixed|string
     */
    public function topRestau()
    {
        return $this->createQueryBuilder('res')
            ->join('App\Entity\Review','rev')
            ->where('rev.restaurant_id=res.id ')
            ->select('res as restaurant,AVG(rev.rating) as moyenne')
            ->orderBy('moyenne','DESC')
            ->groupBy('res.id')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed[]
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function listDetaileRestaurant($id)
    {
        $sql = "SELECT r.id ,r.name , r.description , r.created_at,rv.user_id_id,rv.rating,rv.message,u.username
             FROM restaurant r INNER join review rv on rv.restaurant_id_id=r.id 
            INNER JOIN user u on rv.user_id_id=u.id where r.id=".$id;
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @return mixed[]
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function classRestaurantsParVot()
    {
        $sql = " SELECT r.id ,r.name , r.description , r.create_at ,avg(rv.rating) as moyenne 
             FROM restaurant r INNER join review rv where rv.restaurant_id_id=r.id  GROUP BY r.id ORDER By moyenne asc";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }



    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
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
    public function findOneBySomeField($value): ?Restaurant
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
