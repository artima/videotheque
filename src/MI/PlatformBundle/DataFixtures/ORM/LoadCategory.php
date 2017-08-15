<?php

/**
 * Created by PhpStorm.
 * User: Mitra
 * Date: 17/07/2017
 * Time: 11:04
 */

namespace MI\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MI\PlatformBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'cat1 Horror comedy',
            'cat2 Film noir‎ ',
            'cat3 Sports films‎',
            'cat4 Action',
            'cat5 Thrillers‎'
        );

        foreach ($names as $name) {
            // On crée la catégorie
            $category = new Category();
            $category->setLibelle($name);

            // On la persiste
            $manager->persist($category);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}