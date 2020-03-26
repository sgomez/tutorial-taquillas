<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LockerRepository")
 */
class Locker
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zone", inversedBy="lockers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zone;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="locker", cascade={"persist", "remove"})
     */
    private $lessor;

    public function __toString(): string
    {
        return (string) $this->getCode();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getLessor(): ?User
    {
        return $this->lessor;
    }

    public function setLessor(?User $lessor): self
    {
        $this->lessor = $lessor;

        return $this;
    }
}
