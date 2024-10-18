<?php
// src/Repository/DetteRepository.php
namespace App\Repository;

use App\Entity\Dette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dette::class);
    }

    public function findByStatut(array $statuts)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.statut IN (:statuts)')
            ->setParameter('statuts', $statuts)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
