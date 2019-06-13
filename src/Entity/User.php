<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $money;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $water;

    /**
     * @var Land[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Land", mappedBy="user")
     */
    private $lands;

    /**
     * @var Deposit[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Deposit", mappedBy="user")
     */
    private $deposits;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->deposits = new ArrayCollection();
        $this->lands = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMoney() : ?int
    {
        return $this->money;
    }

    /**
     * @param int $money
     *
     * @return self
     */
    public function setMoney(int $money) : self
    {
        $this->money = $money;
        return $this;
    }

    /**
     * @return int
     */
    public function getWater() : ?int
    {
        return $this->water;
    }

    /**
     * @param int $water
     *
     * @return self
     */
    public function setWater(int $water) : self
    {
        $this->water = $water;
        return $this;
    }

    /**
     * @param Deposit $deposit 
     * 
     * @return self
     */
    public function addDeposit(Deposit $deposit) : self
    {
        if(!$this->deposits->contains($deposit) ) {
            $this->deposits->add($deposit);
        }
        return $this;
    }

    /**
     * @param Deposit $deposit 
     * 
     * @return self
     */
    public function removeDeposit(Deposit $deposit) : self
    {
        $this->deposits->removeElement($deposit);
        return $this;
        
    }

    /**
     * @return Deposit[]|ArrayCollection
     */
    public function getDeposits()
    {
        return $this->deposits;
    }

    /**
     * @return Land[]|ArrayCollection
     */
    public function getLands()
    {
        return $this->lands;
    }

    /**
     * @param Land $land 
     * 
     * @return self
     */
    public function addLand(Land $land) : self
    {
        if(!$this->lands->contains($land) ) {
            $this->lands->add($land);
        }
        return $this;
    }
}