<?php
/**
 * Created by PhpStorm.
 * User: tsvetan
 * Date: 30.10.18
 * Time: 10:29
 */

namespace ProductBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\Product;

class LoadProducts implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $products = [];
        $MAX = 10;
        for($i = 0; $i < $MAX; $i++) {
            $products[$i] = new Product();
            $products[$i]->setName("sample product no $i") ;
            $products[$i]->setDescription("$i $i lorem ipsum description $i");
            $manager->persist($products[$i]);
        }

        $manager->flush();
    }
}