<?php

namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class RendezVousDTO 
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
    private $date;

    /**
     * @OA\Property(type="string")
     *
     * @var string
     */
    private $horaire;

    /**
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $patient;

    /**
     * @OA\Property(type="integer")
     *
     * @var int
     */
    private $specialiste;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHoraire()
    {
        return $this->horaire;
    }

    public function setHoraire($horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function setPatient($patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getSpecialiste()
    {
        return $this->specialiste;
    }

    public function setSpecialiste($specialiste): self
    {
        $this->specialiste = $specialiste;

        return $this;
    }

}

?>