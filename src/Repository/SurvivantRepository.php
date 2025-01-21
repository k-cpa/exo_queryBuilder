<?php

namespace App\Repository;

use App\Entity\Survivant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Survivant>
 */
class SurvivantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survivant::class);
    }

    //    /**
    //     * @return Survivant[] Returns an array of Survivant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Survivant
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

           public function findByAscOrder(): array
       {
           return $this->createQueryBuilder('s')
               ->orderBy('s.nom', 'DESC')
               ->getQuery()
               ->getResult()
           ;
       }

       public function findElfePower(): array
       {
           return $this->createQueryBuilder('s')
               ->join('s.race','r')
               ->andWhere('r.race_name = :raceName')
               ->andWhere('s.puissance >= 25')
               ->setParameter('raceName','Elfe')
               ->getQuery()
               ->getResult()
           ;
       }

       public function filterForm($race,$puissance): array
       {
        //    return $this->createQueryBuilder('s')
        //        ->join('s.race','r')
        //        ->andWhere('r.race_name = :raceName')
        //        ->andWhere('s.puissance >= :puissance')
        //        ->setParameter('raceName',$race)
        //        ->setParameter('puissance',$puissance)
        //        ->getQuery()
        //        ->getResult()
        //    ;

           $qb = $this->createQueryBuilder('s')
           ->join('s.race','r');
           if($race != 'rien'){
            $qb = $qb->andWhere('r.race_name = :raceName')
                        ->setParameter('raceName',$race);
           }
           $qb = $qb->andWhere('s.puissance >= :puissance')  
                    ->setParameter('puissance',$puissance)
                    ->getQuery();
           
           $qb = $qb->getResult();
           return $qb;
       }

       public function totalPower(): array
       {

           $qb = $this->createQueryBuilder('s');

           $qb = $qb->select('r.race_name AS raceName', 'SUM(s.puissance) AS totalPuissance')
                    ->join('s.race','r')
                    ->groupBy('r.race_name')
                    ->getQuery()
                    ->getResult();
           return $qb;
       }

       
}
