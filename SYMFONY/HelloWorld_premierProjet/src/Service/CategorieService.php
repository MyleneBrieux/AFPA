<?php

namespace App\Service;

use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\DriverException;

use App\Service\Exception\CategorieServiceException;

class CategorieService {

    private $repository;
    private $manager;

    public function __construct(CategorieRepository $repository, EntityManagerInterface $manager){
        $this->repository = $repository;
        $this->manager = $manager;
    }



    public function chercherToutesCategories() : array {
        try {
            return $this->repository->findAll();
        } catch (DriverException $e){
            throw new CategorieServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function ajouterCategorieBdd($categorie) {
        try {
            $this->manager->persist($categorie);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new CategorieServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function supprimerCategorie($categorie) {
        try {
            $this->manager->remove($categorie);
            $this->manager->flush();
        } catch (DriverException $e){
            throw new CategorieServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }

    public function chercherUneCategorie(int $id) : object {
        try {
            return $this->repository->find($id);
        } catch (DriverException $e){
            throw new CategorieServiceException("Un problème technique est survenu, veuillez réessayer ultérieurement.");
        }
    }
    
}

?>