<?php

namespace App\DTO;

use App\Entity\User;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class PatientDTO extends User
{

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