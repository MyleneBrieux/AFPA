<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PatientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient extends User
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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="L'âge ne peut pas être vide")
     * @Assert\Length(
     *          min = 2,
     *          max = 2,
     *          minMessage = "L'âge doit comporter au moins {{ limit }} caractères",
     *          maxMessage = "L'âge doit comporter au maximum {{ limit }} caractères"
     * )
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=RendezVous::class, mappedBy="patient", orphanRemoval=true, cascade="remove")
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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
            $rendezVou->setPatient($this);
        }

        return $this;
    }

    public function removeRendezVou(RendezVous $rendezVou): self
    {
        if ($this->rendezVous->removeElement($rendezVou)) {
            // set the owning side to null (unless already changed)
            if ($rendezVou->getPatient() === $this) {
                $rendezVou->setPatient(null);
            }
        }

        return $this;
    }

}
