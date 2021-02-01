<?php

namespace App\DataFixtures;

use App\Repository\SpecialisteRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RemoveSpecialisteFixtures extends Fixture
{

    private $repository;

    public function __construct(SpecialisteRepository $repository){
        $this->repository=$repository;
    }

    public function load(ObjectManager $manager){
        $specialistes=$this->repository->findAll();
            foreach($specialistes as $specialiste){
                $manager->remove($specialiste);
                $manager->flush();
            }
    }

}
