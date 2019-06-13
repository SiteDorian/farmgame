<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Land;

class LandRepository extends EntityRepository
{
    /**
     * @param int $id
     * 
     * @return Land|null
     */
    public function findLandByUser(int $id): ?Land
    {
        return null;
    }

}