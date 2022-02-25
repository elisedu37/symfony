<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoanRepository::class)
 */
class Loan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $finished_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $returned_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="loans")
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="loan")
     */
    private $ressource_id;


    public function __construct()
    {
        $this->ressource_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeImmutable
    {
        return $this->finished_at;
    }

    public function setFinishedAt(\DateTimeImmutable $finished_at): self
    {
        $this->finished_at = $finished_at;

        return $this;
    }

    public function getReturnedAt(): ?\DateTimeImmutable
    {
        return $this->returned_at;
    }

    public function setReturnedAt(\DateTimeImmutable $returned_at): self
    {
        $this->returned_at = $returned_at;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourceId(): Collection
    {
        return $this->ressource_id;
    }

    public function addRessourceId(Ressource $ressourceId): self
    {
        if (!$this->ressource_id->contains($ressourceId)) {
            $this->ressource_id[] = $ressourceId;
            $ressourceId->setLoan($this);
        }

        return $this;
    }

    public function removeRessourceId(Ressource $ressourceId): self
    {
        if ($this->ressource_id->removeElement($ressourceId)) {
            // set the owning side to null (unless already changed)
            if ($ressourceId->getLoan() === $this) {
                $ressourceId->setLoan(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
