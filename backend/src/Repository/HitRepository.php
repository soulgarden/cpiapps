<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Hit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method null|Hit find($id, $lockMode = null, $lockVersion = null)
 * @method null|Hit findOneBy(array $criteria, array $orderBy = null)
 * @method Hit[]    findAll()
 * @method Hit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HitRepository extends ServiceEntityRepository
{
    /**
     * HitRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hit::class);
    }

//    /**
//     * @return Hit[] Returns an array of Hit objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hit
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
