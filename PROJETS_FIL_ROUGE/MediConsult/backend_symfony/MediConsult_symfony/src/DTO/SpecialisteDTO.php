<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class SpecialisteDTO 
{
    /**
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $nom;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $prenom;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $adresse;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $specialite;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSpecialite()
    {
        return $this->specialite;
    }

    public function setSpecialite($specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

}

?>