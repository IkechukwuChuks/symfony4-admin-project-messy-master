<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    /**
     * UserFixture constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("admin");
        $user->setUsername("admin");
        $user->setRoles(["ROLE_ADMIN","ROLE_USER"]);
        $user->setPassword(
            $this->encoder->encodePassword($user, "password")
        );
        $user->setEmail("admin@admin.com");
        $manager->persist($user);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
