<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="deposit")
 */

 class Deposit
 {
     /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @var Plant
     *
     * @ORM\ManyToOne(targetEntity="Plant", inversedBy="deposits")
     * @ORM\JoinColumn(name="plant_id", referencedColumnName="id", nullable=false)
     */
    private $plant;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="deposits")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user) : self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser() : ?User
    {
        return $this->user;
    }

    /**
     * @param Plant $plant
     *
     * @return self
     */
    public function setPlant(Plant $plant) : self
    {
        $this->plant = $plant;
        return $this;
    }

    /**
     * @return Plant
     */
    public function getPlant() : ?Plant
    {
        return $this->plant;
    }

    /**
     * @return int
     */
    public function getCount() : ?int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count) : self
    {
        $this->count = $count;
        return $this;
    }
 }