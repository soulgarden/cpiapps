<?php

namespace App\Repository;

use App\Dictionary\ActivityStatusDictionary;
use App\Entity\Stream;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stream|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stream|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stream[]    findAll()
 * @method Stream[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StreamRepository extends ServiceEntityRepository
{
    /**
     * StreamRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stream::class);
    }

    /**
     * @return Stream[] Returns an array of Stream objects
     */
    public function findAllByActive(): array
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.offer', 'o')
            ->andWhere(
                't.status = :streamStatus AND o.status = :offerStatus AND t.deletedAt IS NULL AND o.deletedAt IS NULL'
            )
            ->setParameter('streamStatus', ActivityStatusDictionary::STATUS_ACTIVE)
            ->setParameter('offerStatus', ActivityStatusDictionary::STATUS_ACTIVE)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
