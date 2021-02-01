<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for ($i=1 ; $i<=5 ; $i++){
            $categorie = new Categorie();

            $designation = $faker->sentence(1);
        
            $categorie->setDesignation($designation);
    
            $manager->persist($categorie);
        }

        $manager->flush();
    }
}
