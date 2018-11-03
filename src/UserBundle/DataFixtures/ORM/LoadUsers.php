<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function load(ObjectManager $manager)
    {


        $admin = new User();
        $admin->setUsername('admin');
        $admin->setId(1);
        $admin->setPassword($this->encodePassword($admin, 'admin123'));
        $admin->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $admin->setEmail('cwakster@gmail.com');
        $manager->persist($admin);

        for($i = 2; $i < 12; $i++) {
            $users[$i] = new User();
            $users[$i]->setId($i);
            $users[$i]->setUsername("user$i");
            $users[$i]->setRoles(['ROLE_USER']);
            $users[$i]->setPassword($this->encodePassword($users[$i], "$i"."userpass"));
            $users[$i]->setEmail("user.no$i@gmail.com");
            $manager->persist($users[$i]);

        }


        $manager->flush();
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user)
        ;

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder()
    {
        return 10;
    }
}
