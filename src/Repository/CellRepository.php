<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Cell;

class CellRepository extends EntityRepository
{
    /**
     * 
     * @return Cell[]
     */
    public function findCells()
    {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->getQuery()
            ->getResult();
    }
}