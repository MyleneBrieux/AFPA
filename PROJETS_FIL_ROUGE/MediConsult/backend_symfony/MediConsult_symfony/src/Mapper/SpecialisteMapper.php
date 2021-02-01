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
        $specialiste->setEmail($specialisteDto->getEmail());
        $specialiste->setPassword(
            $this->passwordEncoder->encodePassword(
                $specialiste,
                $specialisteDto->getPassword()
            )
        );
        return $specialiste;
    }

    public function transformeSpecialisteEntityToSpecialisteDto(Specialiste $specialiste){
        $specialisteDto = new SpecialisteDto();
        $specialisteDto->setNom($specialiste->getNom());
        $specialisteDto->setPrenom($specialiste->getPrenom());
        $specialisteDto->setAdresse($specialiste->getAdresse());
        $specialisteDto->setSpecialite($specialiste->getSpecialite());
        $specialisteDto->setEmail($specialiste->getEmail());
        $specialisteDto->setPassword($specialiste->getPassword());
        return $specialisteDto;
    }

}