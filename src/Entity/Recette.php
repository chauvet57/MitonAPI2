<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
    private $nom_recette;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_personne;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valide;

    /**
     * @ORM\Column(type="time")
     */
    private $temps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="recette")
     */
    private $categories;

    /**
     * @ORM\Column(type="array")
     */
    private $etapes = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images = [];

    /**
     * @ORM\Column(type="array")
     */
    private $ingredients = [];

    /**
     * @ORM\ManyToOne(targetEntity=Price::class, inversedBy="recette")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Difficulte::class, inversedBy="recette")
     */
    private $difficulte;

    

    public function __construct()
    {
        $this->categories = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->nom_recette;
    }

    public function setNomRecette(string $nom_recette): self
    {
        $this->nom_recette = $nom_recette;

        return $this;
    }

    public function getNombrePersonne(): ?int
    {
        return $this->nombre_personne;
    }

    public function setNombrePersonne(int $nombre_personne): self
    {
        $this->nombre_personne = $nombre_personne;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->is_valide;
    }

    public function setIsValide(bool $is_valide): self
    {
        $this->is_valide = $is_valide;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(\DateTimeInterface $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addRecette($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeRecette($this);
        }

        return $this;
    }

    public function getEtapes(): ?array
    {
        return $this->etapes;
    }

    public function setEtapes(array $etapes): self
    {
        $this->etapes = $etapes;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDifficulte(): ?Difficulte
    {
        return $this->difficulte;
    }

    public function setDifficulte(?Difficulte $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }







}
