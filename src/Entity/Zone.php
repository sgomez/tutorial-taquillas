<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZoneRepository")
 */
class Zone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Locker", mappedBy="zone", orphanRemoval=true)
     */
    private $lockers;

    public function __construct()
    {
        $this->lockers = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Locker[]
     */
    public function getLockers(): Collection
    {
        return $this->lockers;
    }

    public function addLocker(Locker $locker): self
    {
        if (!$this->lockers->contains($locker)) {
            $this->lockers[] = $locker;
            $locker->setZone($this);
        }

        return $this;
    }

    public function removeLocker(Locker $locker): self
    {
        if ($this->lockers->contains($locker)) {
            $this->lockers->removeElement($locker);
            // set the owning side to null (unless already changed)
            if ($locker->getZone() === $this) {
                $locker->setZone(null);
            }
        }

        return $this;
    }
}
