<?php

namespace App\Repository;

use App\Entity\GameScenario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameScenario|null find( $id, $lockMode = null, $lockVersion = null )
 * @method GameScenario|null findOneBy( array $criteria, array $orderBy = null )
 * @method GameScenario[]    findAll()
 * @method GameScenario[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class ScenarioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct( $registry, GameScenario::class );
    }

    // /**
    //  * @return Scenario[] Returns an array of Scenario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Scenario
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
