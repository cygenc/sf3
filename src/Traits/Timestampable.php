<?php

namespace App\Traits;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

trait Timestampable
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    // /**
    //  * @ORM\ManyToOne(targetEntity="App\Entity\User")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // protected $createdBy;

    // /**
    //  * @ORM\ManyToOne(targetEntity="App\Entity\User")
    //  */
    // protected $updatedBy;

    /**
     * @ORM\PreUpdate
     */
    public function update()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    // public function getCreatedBy(): ?User
    // {
    //     return $this->createdBy;
    // }

    // public function setCreatedBy(?User $createdBy): self
    // {
    //     $this->createdBy = $createdBy;

    //     return $this;
    // }

    // public function getUpdatedBy(): ?User
    // {
    //     return $this->updatedBy;
    // }

    // public function setUpdatedBy(?User $updatedBy): self
    // {
    //     $this->updatedBy = $updatedBy;

    //     return $this;
    // }
}
