<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @UniqueEntity("titre")
 */
class Produit
{
    function __construct()
    {
        $this->created_at = new DateTime();
        $this->options = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=7, max=50)
     */
    private $titre;
         
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descri;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(max=1000, min=45)
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantitie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $solde;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Option", inversedBy="produits")
     */
    private $options;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): string{
       return (new Slugify())->slugify($this->titre); // hello-world
    }

    public function getDescri(): ?string
    {
        return $this->descri;
    }

    public function setDescri(?string $descri): self
    {
        $this->descri = $descri;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFormattedPrix() : string {
        return number_format($this->prix,0, '', ' ');
    }

    public function getQuantitie(): ?int
    {
        return $this->quantitie;
    }

    public function setQuantitie(int $quantitie): self
    {
        $this->quantitie = $quantitie;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getSolde(): ?bool
    {
        return $this->solde;
    }

    public function setSolde(bool $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProduit($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $option->removeProduit($this);
        }

        return $this;
    }
}
