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

    public function findByRace(string $race)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.race = :race')
            ->setParameter('race', $race)
            ->getQuery()
            ->getResult();
    }

    public function findByName(string $nom)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.nom = :nom')
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getResult();
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
