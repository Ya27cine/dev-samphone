<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;



class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('fr_FR');
        for($i=0; $i < 100; $i++){
            $produit = new Produit();
            $produit->setTitre( $faker->words(6, true));
            $produit->setDescri( $faker->sentences(1, true));
            $produit->setPrix( $faker->numberBetween(65, 380));
            $produit->setQuantitie( $faker->numberBetween(1, 5));
            $produit->setSolde(false);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
