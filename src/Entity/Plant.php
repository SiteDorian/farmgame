<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlantRepository")
 * @ORM\Table(name="plants")
 */
class Plant
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
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $price_buy;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $price_sell;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @var Cell[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Cell", mappedBy="plant")
     */
    private $cells;

    /**
     * @var Deposit[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Deposit", mappedBy="plant")
     */
    private $deposits;

    public function __construct()
    {
        $this->cells = new ArrayCollection();
        $this->deposits = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getPrice_buy() : ?int
    {
        return $this->price_buy;
    }

    /**
     * @param int $price
     * 
     * @return self
     */
    public function setPrice_buy(int $price) : self
    {
        $this->price_buy=$price;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getPrice_sell() : ?int
    {
        return $this->price_sell;
    }

    /**
     * @param int $price
     * 
     * @return self
     */
    public function setPrice_sell(int $price) : self
    {
        $this->price_sell=$price;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImg() : ?string
    {
        return $this->img;
    }

    /**
     * @param string|null $img
     *
     * @return self
     */
    public function setImg(?string $img) : self
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return int
     */
    public function getTime() : ?int
    {
        return $this->time;
    }

    /**
     * @param int $time
     *
     * @return self
     */
    public function setTime(int $time) : self
    {
        $this->time = $time;
        return $this;
    }
}