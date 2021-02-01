<?php

namespace App\Service;

use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;

use App\Service\Exception\AdresseServiceException;

class AdresseService {

    private $repository;
    private $manager;

    public function __construct(AdresseRepository $repository, EntityManagerInterface $manager){
        $this->repository = $repository;
        $this->manager = $manager;
    }


    public function chercherToutesAdresses() : array {
        try {
            return $this->repository->findAll();
        } catch (DriverException $e){
            throw new AdresseServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function ajouterAdresseBdd($adresse) {
        try {
            $this->manager->persist($adresse);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new AdresseServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function supprimerAdresse($adresse) {
        try {
            $this->manager->remove($adresse);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new AdresseServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function chercherUneAdresse(int $id) : object {
        try {
            return $this->repository->find($id);
        } catch (DriverException $e){
            throw new AdresseServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }
    
}

?>