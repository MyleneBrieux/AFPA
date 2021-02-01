<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('mylene.brieux@gmail.com');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'afpa'
        ));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('doniphanolivier@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            '27051994'
        ));
        $manager->persist($user2);
        
        $user3 = new User();
        $user3->setEmail('carotteolivier@gmail.com');
        $user3->setRoles(['ROLE_USER']);
        $user3->setPassword($this->passwordEncoder->encodePassword(
            $user3,
            'chat'
        ));
        $manager->persist($user3);

        $manager->flush();
    }
}
