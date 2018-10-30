<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {


        $admin = new User();
        $admin->setName('admin');
        $admin->setId(1);
        $admin->setPassword($this->encodePassword($admin, 'admin123'));
        $admin->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $admin->setEmail('cwakster@gmail.com');
        $manager->persist($admin);

        for($i = 2; $i < 11; $i++) {
            $users[$i] = new User();
            $users[$i]->setId($i);
            $users[$i]->setName("User$i");
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
}
