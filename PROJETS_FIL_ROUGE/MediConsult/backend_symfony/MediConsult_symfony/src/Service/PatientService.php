<?php

namespace App\Service;


use App\DTO\PatientDTO;
use App\Entity\Patient;
use App\Mapper\PatientMapper;
use App\Mapper\SpecialisteMapper;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\PatientServiceException;

class PatientService {

    private $repository;
    private $entityManager;
    private $patientMapper;

    public function __construct(PatientRepository $repository, EntityManagerInterface $entityManager, PatientMapper $patientMapper){
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->patientMapper = $patientMapper;
    }

    public function searchAllSpecialistesForOnePatient(int $id){
        try{
            $patient=$this->patientRepository->find($id);
            $rdvs= $patient->getRendezVous();
            foreach($rdvs as $rdv){
               $specialistes[]= $this->specialisteMapper->transformeSpecialisteEntityToSpecialisteDto($rdv->getSpecialiste());
            }
            return $specialistes;
        }catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    } 

    public function delete(Patient $patient){
        try {
            $this->entityManager->remove($patient);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function persist(Patient $patient, PatientDTO $patientDto){
        try{
            $patient = $this->patientMapper->transformePatientDtoToPatientEntity($patientDto, $patient);
            $this->entityManager->persist($patient);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id){
        try {
            $patient = $this->repository->find($id);
            return $this->patientMapper->transformePatientEntityToPatientDto($patient);
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchByNom(string $nom){
        try {
            $patients = $this->repository->searchByNom($nom);
            $patientDtos=[];

            foreach ($patients as $key=>$value){
                $patient = (new Patient);
                $patient->setId($patients[$key]->getId($value))
                          ->setNom($patients[$key]->getNom($value))
                          ->setPrenom($patients[$key]->getPrenom($value))
                          ->setAge($patients[$key]->getAge($value));
                $patientDtos[]=$this->patientMapper->transformePatientEntityToPatientDto($patient);
            }
            return $patientDtos;
        } catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAllRendezVousForOnePatient(int $id){
        try{
            $patient=$this->patientRepository->find($id);
            $rdvs= $patient->getRendezVous();
            foreach($rdvs as $rdv){
               $rendezVous[]= $this->rendezVousMapper->transformeRendezVousEntityToRendezVousDto($rdv->getId());
            }
            return $rendezVous;
        }catch(DriverException $e){
            throw new PatientServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    } 

}

?>