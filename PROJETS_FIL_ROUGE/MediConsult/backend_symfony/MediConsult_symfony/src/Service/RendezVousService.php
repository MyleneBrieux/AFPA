<?php

namespace App\Service;


use App\DTO\RendezVousDTO;
use App\Entity\RendezVous;
use App\Mapper\RendezVousMapper;
use App\Repository\PatientRepository;
use App\Repository\SpecialisteRepository;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;
use App\Service\Exception\RendezVousServiceException;

class RendezVousService {

    private $repository;
    private $entityManager;
    private $rendezVousMapper;
    private $specialisteRepository;
    private $patientRepository;

    public function __construct(RendezVousRepository $repository, EntityManagerInterface $entityManager, RendezVousMapper $rendezVousMapper,
                                SpecialisteRepository $specialisteRepository, PatientRepository $patientRepository){
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->rendezVousMapper = $rendezVousMapper;
        $this->specialisteRepository = $specialisteRepository;
        $this->patientRepository = $patientRepository;
    }

    public function delete(RendezVous $rendezVous){
        try {
            $this->entityManager->remove($rendezVous);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new RendezVousServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function persist(RendezVous $rendezVous, RendezVousDTO $rendezVousDto){
        try{
            $specialiste = $this->specialisteRepository->find($rendezVousDto->getSpecialiste());
            $patient = $this->patientRepository->find($rendezVousDto->getPatient());
            $rendezVous = $this->rendezVousMapper->transformeRendezVousDtoToRendezVousEntity($rendezVousDto, $rendezVous, $specialiste, $patient);
            $this->entityManager->persist($rendezVous);
            $this->entityManager->flush();
        } catch(DriverException $e){
            throw new RendezVousServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }

    public function searchById(int $id){
        try {
            $rendezVous = $this->repository->find($id);
            return $this->rendezVousMapper->transformeRendezVousEntityToRendezVousDto($rendezVous);
        } catch(DriverException $e){
            throw new RendezVousServiceException("Un problème est technique est servenu. Veuilllez réessayer ultérieurement.", $e->getCode());
        }
    }


}

?>