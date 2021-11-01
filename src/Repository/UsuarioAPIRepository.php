<?php

namespace App\Repository;

use     App\Entity\UsuarioAPI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsuarioAPI|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioAPI|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioAPI[]    findAll()
 * @method UsuarioAPI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioAPIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioAPI::class);
    }

    // /**
    //  * @return UsuarioAPI[] Returns an array of UsuarioAPI objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsuarioAPI
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
