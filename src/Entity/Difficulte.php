<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DifficulteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DifficulteRepository::class)
 */
class Difficulte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"recette"})
     */
    private $id;

    /**
     * @Groups({"read: recette"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom_difficulte;

    /**
     * @ORM\OneToMany(targetEntity=Recette::class, mappedBy="difficulte")
     */
    private $recette;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDifficulte(): ?string
    {
        return $this->nom_difficulte;
    }

    public function setNomDifficulte(string $nom_difficulte): self
    {
        $this->nom_difficulte = $nom_difficulte;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->setDifficulte($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recette->contains($recette)) {
            $this->recette->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getDifficulte() === $this) {
                $recette->setDifficulte(null);
            }
        }

        return $this;
    }
}
