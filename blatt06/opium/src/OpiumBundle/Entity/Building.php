<?php

namespace OpiumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="OpiumBundle\Repository\BuildingRepository")
 */
class Building
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OpiumBundle\Entity\Room", mappedBy="building")
     */
    private $rooms;


    /**
     * Building constructor.
     */
    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Building
     */
    public function setNumber(string $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return ArrayCollection
     */
    public function getRooms(): ArrayCollection
    {
        return $this->rooms;
    }

    /**
     * @param Room $room
     * @return bool
     */
    public function addRoom(Room $room): bool
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            return true;
        }
        return false;
    }

    /**
     * @param Room $room
     * @return bool
     */
    public function removeRoom(Room $room): bool
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
            return true;
        }
        return false;
    }
}

