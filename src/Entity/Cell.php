<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CellRepository")
 * @ORM\Table(name="cells")
 * @ORM\HasLifecycleCallbacks()
 */
class Cell
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
    private $stage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @var Land
     *
     * @ORM\ManyToOne(targetEntity="Land", inversedBy="cells")
     * @ORM\JoinColumn(name="land_id", referencedColumnName="id", nullable=false)
     */
    private $land;

    /**
     * @var Plant
     *
     * @ORM\ManyToOne(targetEntity="Plant", inversedBy="cells")
     * @ORM\JoinColumn(name="plant_id", referencedColumnName="id")
     */
    private $plant;

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * 
     * @return int
     */
    public function getStage() : ?int
    {
        return $this->stage;
    }

    /**
     * @param int $stage
     * 
     * @return self
     */
    public function setStage(int $stage) : self
    {
        $this->stage=$stage;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime() : ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     *
     * @return self
     */
    public function setTime(\DateTime $time) : self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @param Land $land
     *
     * @return self
     */
    public function setLand(Land $land) : self
    {
        $this->land = $land;
        return $this;
    }

    /**
     * @return Land
     */
    public function getLand() : ?Land
    {
        return $this->Land;
    }

    /**
     * @param Plant $plant
     *
     * @return self
     */
    public function setPlant(Plant $plant=null) : self
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
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->time = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->time = new \DateTime();
    }
}