<?php

namespace App\Mapper;

use DateTime;
use App\Entity\Patient;
use App\Entity\Specialiste;
use App\DTO\RendezVousDTO;
use App\Entity\RendezVous;

class RendezVousMapper {

    public function transformeRendezVousDtoToRendezVousEntity(RendezVousDTO $rendezVousDto, RendezVous $rendezVous, Specialiste $specialiste, Patient $patient){
        $rendezVous->setDate(new DateTime($rendezVousDto->getDate()));
        $rendezVous->setHoraire(new DateTime($rendezVousDto->getHoraire()));
        $rendezVous->setSpecialiste($specialiste);
        $rendezVous->setPatient($patient);
        return $rendezVous;
    }

    public function transformeRendezVousEntityToRendezVousDto(RendezVous $rendezVous){
        $rendezVousDto = new RendezVousDTO();
        $rendezVousDto->setId($rendezVous->getId());
        $rendezVousDto->setDate($rendezVous->getDate()->format("d-m-Y"));
        $rendezVousDto->setHoraire($rendezVous->getHoraire()->format("H:i"));
        $rendezVousDto->setSpecialiste($rendezVous->getSpecialiste()->getId());
        $rendezVousDto->setPatient($rendezVous->getPatient()->getId());
        return $rendezVousDto;
    }

}