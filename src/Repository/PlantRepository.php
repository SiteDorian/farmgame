<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Plant;

class PlantRepository extends EntityRepository
{
    /**
     * @param int $id
     * 
     * @return Plant|null
     */
    public function findPlant(int $id): ?Plant
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param int $id
     * 
     * @return int|null
     */
    public function getTimeById(int $id): ?int
    {
        return $this->createQueryBuilder('p')
            ->select('p.time')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}