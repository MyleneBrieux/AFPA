<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class PatientDTO 
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
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $age;


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

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }

}

?>