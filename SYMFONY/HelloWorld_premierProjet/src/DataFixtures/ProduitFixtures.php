<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for ($i=1 ; $i<=30 ; $i++){
            $produit = new Produit();

            $libelle = $faker->sentence(5);
            $couleur = $faker->sentence(1);
            $categorie = $faker->sentence(1);
        
            $produit->setLibelle($libelle)
                    ->setPrix(mt_rand(2.99,49.99))
                    ->setCouleur($couleur)
                    ->setCategorie($categorie);
    
            $manager->persist($produit);
        }

        $manager->flush();
    }
}
