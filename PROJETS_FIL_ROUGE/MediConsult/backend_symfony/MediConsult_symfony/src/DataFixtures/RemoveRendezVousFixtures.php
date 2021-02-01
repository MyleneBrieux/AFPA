<?php

namespace App\DataFixtures;

use App\Repository\RendezVousRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RemoveRendezVousFixtures extends Fixture
{

    private $repository;

    public function __construct(RendezVousRepository $repository){
        $this->repository=$repository;
    }

    public function load(ObjectManager $manager){
        $rendezVous=$this->repository->findAll();
            foreach($rendezVous as $rdv){
                $manager->remove($rdv);
                $manager->flush();
            }
    }

}
