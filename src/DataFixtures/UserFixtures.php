<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@admin.com");
        $admin->setPassword('$2y$13$u8udNvP0UFi/48tUW6Hsu.XKxnPb9DrV8fHw7t758jgRUK1AkAZ..');
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setIsVerified(true);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail("user@user.com");
        $user->setPassword('$2y$13$u8udNvP0UFi/48tUW6Hsu.XKxnPb9DrV8fHw7t758jgRUK1AkAZ..');
        $user->setRoles(["ROLE_USER"]);
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }
}
