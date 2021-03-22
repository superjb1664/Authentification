<?php

namespace App\Repository;

use App\Entity\CommentaireAtelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireAtelier|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireAtelier|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireAtelier[]    findAll()
 * @method CommentaireAtelier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireAtelierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireAtelier::class);
    }

    // /**
    //  * @return CommentaireAtelier[] Returns an array of CommentaireAtelier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentaireAtelier
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
