<?php

namespace App\Repository;

use App\Entity\PalierOrigine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PalierOrigine>
 *
 * @method PalierOrigine|null find($id, $lockMode = null, $lockVersion = null)
 * @method PalierOrigine|null findOneBy(array $criteria, array $orderBy = null)
 * @method PalierOrigine[]    findAll()
 * @method PalierOrigine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PalierOrigineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PalierOrigine::class);
    }

//    /**
//     * @return PalierOrigine[] Returns an array of PalierOrigine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PalierOrigine
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
