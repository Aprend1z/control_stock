<?php

namespace App\Repository;

use App\Entity\TblTipoMovimiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TblTipoMovimiento>
 */
class TblTipoMovimientoRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, TblTipoMovimiento::class);
  }

  //    /**
  //     * @return TblTipoMovimiento[] Returns an array of TblTipoMovimiento objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('t')
  //            ->andWhere('t.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('t.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?TblTipoMovimiento
  //    {
  //        return $this->createQueryBuilder('t')
  //            ->andWhere('t.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
