<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SpecialisteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SpecialisteRepository::class)
 */
class Specialiste extends User
{

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @Assert\Length(
     *          min = 3,
     *          max = 50,
     *          minMessage = "Le nom doit comporter au moins {{ limit }} caractères",
     *          maxMessage = "Le nom doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le prénom ne peut pas être vide")
     * @Assert\Length(
     *          min = 3,
     *          max = 50,
     *          minMessage = "Le prénom doit comporter au moins {{ limit }} caractères",
     *          maxMessage = "Le prénom doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse ne peut pas être vide")
     * @Assert\Length(
     *          max = 255,
     *          maxMessage = "L'adresse doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La spécialité ne peut pas être vide")
     * @Assert\Length(
     *          max = 255,
     *          maxMessage = "La spécialité doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $specialite;

    /**
     * @ORM\OneToMany(targetEntity=RendezVous::class, mappedBy="specialiste", orphanRemoval=true, cascade="remove")
     */
    private $rendezVous;


    public function __construct()
    {
        $this->rendezVous = new ArrayCollection();
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * @return Collection|RendezVous[]
     */
    public function getRendezVous(): Collection
    {
        return $this->rendezVous;
    }

    public function addRendezVou(RendezVous $rendezVou): self
    {
        if (!$this->rendezVous->contains($rendezVou)) {
            $this->rendezVous[] = $rendezVou;
            $rendezVou->setSpecialiste($this);
        }

        return $this;
    }

    public function removeRendezVou(RendezVous $rendezVou): self
    {
        if ($this->rendezVous->removeElement($rendezVou)) {
            // set the owning side to null (unless already changed)
            if ($rendezVou->getSpecialiste() === $this) {
                $rendezVou->setSpecialiste(null);
            }
        }

        return $this;
    }

}
