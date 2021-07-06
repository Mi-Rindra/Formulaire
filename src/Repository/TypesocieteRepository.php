<?php

namespace App\Repository;

use App\Entity\Typesociete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Typesociete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typesociete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typesociete[]    findAll()
 * @method Typesociete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesocieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typesociete::class);
    }

    // /**
    //  * @return Typesociete[] Returns an array of Typesociete objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Typesociete
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
