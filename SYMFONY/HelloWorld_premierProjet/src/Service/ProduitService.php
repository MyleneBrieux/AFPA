<?php

namespace App\Service;

use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;

use App\Service\Exception\ProduitServiceException;

class ProduitService {

    private $repository;
    private $manager;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $manager){
        $this->repository = $repository;
        $this->manager = $manager;
    }


    public function chercherTousProduits() : array {
        try {
            return $this->repository->findAll();
        } catch (DriverException $e){
            throw new ProduitServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function ajouterProduitBdd($produit) {
        try {
            $this->manager->persist($produit);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new ProduitServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function supprimerProduit($produit) {
        try {
            $this->manager->remove($produit);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new ProduitServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function chercherUnProduit(int $id) : object {
        try {
            return $this->repository->find($id);
        } catch (DriverException $e){
            throw new ProduitServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }
    
}

?>