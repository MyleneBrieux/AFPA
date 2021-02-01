<?php

namespace App\Mapper;

use App\DTO\SpecialisteDTO;
use App\Entity\Specialiste;

class SpecialisteMapper {

    public function transformeSpecialisteDtoToSpecialisteEntity(SpecialisteDTO $specialisteDto, Specialiste $specialiste){
        $specialiste->setNom($specialisteDto->getNom());
        $specialiste->setPrenom($specialisteDto->getPrenom());
        $specialiste->setSpecialite($specialisteDto->getSpecialite());
        $specialiste->setAdresse($specialisteDto->getAdresse());
        return $specialiste;
    }

    public function transformeSpecialisteEntityToSpecialisteDto(Specialiste $specialiste){
        $specialisteDto = new SpecialisteDto();
        $specialisteDto->setNom($specialiste->getNom());
        $specialisteDto->setPrenom($specialiste->getPrenom());
        $specialisteDto->setAdresse($specialiste->getAdresse());
        $specialisteDto->setSpecialite($specialiste->getSpecialite());
        return $specialisteDto;
    }

}