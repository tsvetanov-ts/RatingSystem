<?php
/**
 * Created by PhpStorm.
 * User: tsvetan
 * Date: 30.10.18
 * Time: 10:30
 */

namespace ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Reviews;
use ProductBundle\Repository\ProductRepository;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

class LoadReviews implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $reviews = [];
        //Loop through previously created products
        for ($i = 1; $i < 11; $i++) {
            //Loop through users but don't randomly skip some to make it more random
            for ($j = 2; $j < 12; $j++) {


                $random_rating = random_int(1, 5);
                $random_skip = random_int(1, 7);

                if (!$random_skip % 3) {
                    continue;
                }
                //hacky way to randomly set review to approved or not
                $random_is_approved = random_int(2, 3) % 2 ? true : false;
                /** @var User $user */
                $user = $manager->getRepository('UserBundle:User')->findOneBy(['id' => $j]);
                /** @var Product $product */
//                $repo = new ProductRepository($manager,Product::class);
                $product = $manager->getRepository('ProductBundle:Product')->findOneBy(['id' => $i])->;

//                var_dump([['repo'=> var_dump($manager->getRepository('UserBundle:User')),'ids' => $i, 'ji' => $j], 'user' => $user, 'product' => $product]);

                $reviews[$i] = new Reviews();
                $reviews[$i]->setProducts($product);
                $reviews[$i]->setUsers($user);
                $reviews[$i]->setRating($random_rating);
                $reviews[$i]->setIsApproved($random_is_approved);

                //todo generate more random review description texts
                $descr = "$i.$j descr: lorem ipsum is it good? IMHO $random_is_approved";

                $reviews[$i]->setDescription($descr);

                $manager->persist($reviews[$i]);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}