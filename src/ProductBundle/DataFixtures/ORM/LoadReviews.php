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
use ProductBundle\Entity\Reviews;
use ProductBundle\Repository\ProductRepository;
use UserBundle\Repository\UserRepository;

class LoadReviews implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $reviews = [];

        for($i = 1; $i < 11; $i++) {
            for($j = 0; $j < 10; $j++) {


                $random_user_id = random_int(2,11);
                $random_rating = random_int(1,5);
                //hacky way to randomly set review to approved or not
                $random_is_approved = random_int(2,3) % 2 ? true: false;

                $user = $manager->getRepository('UserBundle:User')->findOneBy(['id'=>$random_user_id]);
                $product = $manager->getRepository('ProductBundle:Product')->findOneBy(['id'=>$i]);

                $reviews[$j] = new Reviews();
                $reviews[$j]->setProduct($product);
                $reviews[$j]->setUser($user);
                $reviews[$j]->setRating($random_rating);
                $reviews[$j]->setIsApproved($random_is_approved);

                //todo generate more random review description texts
                $descr = "$i.$j descr: lorem ipsum is it good? IMHO $random_is_approved";

                $reviews[$j]->setDescription($descr);

                $manager->persist($reviews[$j]);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}