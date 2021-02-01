<?php

namespace App\DataFixtures;

use App\Repository\PatientRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RemovePatientFixtures extends Fixture
{

    private $repository;

    public function __construct(PatientRepository $repository){
        $this->repository=$repository;
    }

    public function load(ObjectManager $manager){
        $patients=$this->repository->findAll();
            foreach($patients as $patient){
                $manager->remove($patient);
                $manager->flush();
            }
    }

}
