<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RessourceRepository::class)
 */
class Ressource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="integer")
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity_total;

    /**
     * @ORM\ManyToOne(targetEntity=Loan::class, inversedBy="ressource_id")
     */
    private $loan;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, mappedBy="ressource")
     */
    private $group_id;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="ressources")
     */
    private $category;

    public function __construct()
    {
        $this->group_id = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getImage(): ?int
    {
        return $this->image;
    }

    public function setImage(int $image): self
    {
        $this->image = $image;

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

    public function getQuantityTotal(): ?float
    {
        return $this->quantity_total;
    }

    public function setQuantityTotal(float $quantity_total): self
    {
        $this->quantity_total = $quantity_total;

        return $this;
    }

    public function getLoan(): ?Loan
    {
        return $this->loan;
    }

    public function setLoan(?Loan $loan): self
    {
        $this->loan = $loan;

        return $this;
    }

    /**
     * @return Collection|group[]
     */
    public function getGroupId(): Collection
    {
        return $this->group_id;
    }

    public function addGroupId(group $groupId): self
    {
        if (!$this->group_id->contains($groupId)) {
            $this->group_id[] = $groupId;
            $groupId->setRessource($this);
        }

        return $this;
    }

    public function removeGroupId(group $groupId): self
    {
        if ($this->group_id->removeElement($groupId)) {
            // set the owning side to null (unless already changed)
            if ($groupId->getRessource() === $this) {
                $groupId->setRessource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
}
