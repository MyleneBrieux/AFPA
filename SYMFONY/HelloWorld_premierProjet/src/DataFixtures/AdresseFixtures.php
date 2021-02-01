<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adresse;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for ($i=1 ; $i<=10 ; $i++){
            $adresse = new Adresse();

            $libelle = $faker->sentence();
            $client = $faker->sentence(1);
        
            $adresse->setLibelle($libelle)
                    ->setClient($client);
    
            $manager->persist($adresse);
        }

        $manager->flush();
    }
}
