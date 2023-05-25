<?php

namespace App\Repository;
use DateTime;
use App\Entity\Offrevoyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offrevoyage>
 *
 * @method Offrevoyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offrevoyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offrevoyage[]    findAll()
 * @method Offrevoyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffrevoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offrevoyage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Offrevoyage $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Offrevoyage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
  

    public function findByDateRange(?DateTime $startDate, ?DateTime $endDate)
    {
        $qb = $this->createQueryBuilder('o');

        if ($startDate !== null) {
            $qb->andWhere('o.start_date >= :startDate')
                ->setParameter('startDate', $startDate);
        }

        if ($endDate !== null) {
            $qb->andWhere('o.end_date <= :endDate')
                ->setParameter('endDate', $endDate);
        }

        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Offrevoyage[] Returns an array of Offrevoyage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offrevoyage
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
