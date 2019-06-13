<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lands")
 */

 class Land
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
     * @var Cell[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Cell", mappedBy="land")
     */
    private $cells;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="lands")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->cells = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return Cell[]|ArrayCollection
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @return User
     */
    public function getUser() : ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * 
     * @return self
     */
    public function setUser($user) : self
    {
        $this->user=$user;
        return $this;
    }
 }