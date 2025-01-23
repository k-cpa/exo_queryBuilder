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

    public function findByFilters(array $filters)
    {
        $qb = $this->createQueryBuilder('s');
        
        // Filtrer par nom si présent
        if (!empty($filters['nom'])) {
            $qb->andWhere('s.nom LIKE :nom')
               ->setParameter('nom', '%' . $filters['nom'] . '%');
        }
    
        // Filtrer par race si présente
        if (!empty($filters['race'])) {
            $qb->andWhere('s.race IN (:race)')
               ->setParameter('race', $filters['race']);
        }
    
        // Filtrer par power_min si présent
        if (!empty($filters['power_min'])) {
            $qb->andWhere('s.puissance >= :puissance')
               ->setParameter('puissance', $filters['power_min']);
        }
    
        // Filtrer par classe si présente (multiple classes avec IN)
        if (!empty($filters['classe'])) {
            $qb->innerJoin('s.classe', 'c')
               ->andWhere('c.id IN (:classIds)')
               ->setParameter('classIds', $filters['classe']);
        }
    
        return $qb->getQuery()->getResult();
    }

    public function findByRaceAndPower(string $race, int $puissance)
    {

        $qb = $this->createQueryBuilder('s');

            if (!empty($race)) {
                $qb->andWhere('s.race = :race')
                ->setParameter('race', $race);
            }
        
            if (!empty($puissance)) {
                $qb->andWhere('s.puissance >= :puissance')
                ->setParameter('race', $race)
                ->setParameter('puissance', $puissance);
            }
            return $qb->getQuery()->getResult();
    }

    public function totalRacePower ()
    {
        return $this->createQueryBuilder('s')
            ->select ('r.race_name AS race', 'SUM(s.puissance) AS totalPower')
            ->join('s.race', 'r')
            ->groupBy('r.race_name')
            ->getQuery()
            ->getResult();
    }

    public function findByNotRace(string $race)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.race != :race')
            ->setParameter('race', $race)
            ->getQuery()
            ->getResult();
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


}
