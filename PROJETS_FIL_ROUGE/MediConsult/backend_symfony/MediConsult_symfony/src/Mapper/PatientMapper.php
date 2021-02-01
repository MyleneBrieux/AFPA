<?php

namespace App\Mapper;

use App\DTO\PatientDTO;
use App\Entity\Patient;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PatientMapper {

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder; 
    }

    public function transformePatientDtoToPatientEntity(PatientDTO $patientDto, Patient $patient){
        $patient->setNom($patientDto->getNom());
        $patient->setPrenom($patientDto->getPrenom());
        $patient->setAge($patientDto->getAge());
        $patient->setEmail($patientDTO->getEmail());
        $patient->setPassword(
            $this->passwordEncoder->encodePassword(
                $patient,
                $patientDTO->getPassword()
            )
        );
        return $patient;
    }

    public function transformePatientEntityToPatientDto(Patient $patient){
        $patientDto = new PatientDTO();
        $patientDto->setNom($patient->getNom());
        $patientDto->setPrenom($patient->getPrenom());
        $patientDto->setAge($patient->getAge());
        $patientDto->setEmail($patient->getEmail());
        $patientDto->setPassword($patient->getPassword());
        return $patientDto;
    }

}