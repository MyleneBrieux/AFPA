<?php

namespace App\Service;


use App\DTO\SpecialisteDTO;
use App\Entity\Specialiste;
use App\Mapper\SpecialisteMapper;
use App\Mapper\PatientMapper;
use App\Mapper\RendezVousMapper;
use App\Repository\SpecialisteRepository;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\SpecialisteServiceException;

class SpecialisteService {

    private $repository;
    private $entityManager;
    private $specialisteMapper;
    private $patientMapper;
    private $rendezVousMapper;

    public function __construct(SpecialisteRepository $repository, EntityManagerInterface $entityManager, SpecialisteMapper $specialisteMapper, PatientMapper $patientMapper, RendezVousMapper $rendezVousMapper){
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->specialisteMapper = $specialisteMapper;
        $this->patientMapper = $patientMapper;
        $this->rendezVousMapper = $rendezVousMapper;
    }

    public function searchAll() {
        try {
            $specialistes = $this->repository->findAll();
            $specialisteDTOs = [];
            foreach ($specialistes as $specialiste) {
                $specialisteDTOs[] = $this->specialisteMapper->transformeSpecialisteEntityToSpecialisteDto($specialiste);
            }
            return $specialisteDTOs;
        } catch (DriverException $e){
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function delete(Specialiste $specialiste){
        try {
            $this->entityManager->remove($specialiste);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function persist(Specialiste $specialiste, SpecialisteDTO $specialisteDTO){
        try{
            $specialiste = $this->specialisteMapper->transformeSpecialisteDtoToSpecialisteEntity($specialisteDTO, $specialiste);
            $this->entityManager->persist($specialiste);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new SpecialisteServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function searchById(int $id){
        try {
            $specialiste = $this->repository->find($id);
            return $this->specialisteMapper->transformeSpecialisteEntityToSpecialisteDto($specialiste);
        } catch(DriverException $e){
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchBySpecialite(string $specialite){
        try {
            $specialistes = $this->repository->findBy(["specialite" => $specialite]);
            $specialisteDtos = [];
            foreach ($specialistes as $specialiste) {
                $specialisteDtos[] = $this->specialisteMapper->transformeSpecialisteEntityToSpecialisteDto($specialiste);
            }
            return $specialisteDtos;
        } catch (DriverException $e) {
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAllPatientsForOneSpecialiste(int $id){
        try{
            $specialiste = $this->repository->find($id);
            $rdvs= $specialiste->getRendezVous();
            
            foreach($rdvs as $rdv){
               $patients[]=$this->patientMapper->transformePatientEntityToPatientDto($rdv->getPatient());
            }

            return $patients;
        }catch(DriverException $e){
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchAllRendezVousForOneSpecialiste(int $id){
        try{
            $specialiste=$this->repository->find($id);
            $rdvs= $specialiste->getRendezVous();
            foreach($rdvs as $rdv){
               $rendezVous[]= $this->rendezVousMapper->transformeRendezVousEntityToRendezVousDto($rdv);
            }
            return $rendezVous;
        }catch(DriverException $e){
            throw new SpecialisteServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    } 


}

?>