<?php

namespace App\Service;

use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;

use App\Service\Exception\ClientServiceException;

class ClientService {

    private $repository;
    private $manager;

    public function __construct(ClientRepository $repository, EntityManagerInterface $manager){
        $this->repository = $repository;
        $this->manager = $manager;
    }

    public function chercherTousClients() : array {
        try {
            return $this->repository->findAll();
        } catch (DriverException $e){
            throw new ClientServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function ajouterClientBdd($client) {
        try {
            $this->manager->persist($client);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new ClientServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    
    public function supprimerClient($client) {
        try {
            $this->manager->remove($client);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new ClientServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function chercherUnClient(int $id) : object {
        try {
            return $this->repository->find($id);
        } catch (DriverException $e){
            throw new ClientServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }
    
}

?>