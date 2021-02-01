<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le libellé ne doit pas être vide")
     * @Assert\Length(
     *          min = 5,
     *          max = 100,
     *          minMessage = "Le libellé doit comporter au moins {{ limit }} caractères",
     *          maxMessage = "Le libellé doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Le prix ne doit pas être vide")
     * @Assert\Positive
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Le libellé ne doit pas être vide")
     * @Assert\Length(
     *          min = 2,
     *          max = 20,
     *          minMessage = "La couleur doit comporter au moins {{ limit }} caractères",
     *          maxMessage = "La couleur doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="produits")
     * @JoinTable(name="produit_client")
     */
    private $client;

    public function __construct()
    {
        $this->client = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }


    public function addClient(Client $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        $this->client->removeElement($client);

        return $this;
    }

}
