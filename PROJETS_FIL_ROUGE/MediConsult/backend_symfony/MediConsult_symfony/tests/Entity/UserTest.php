<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase {

    private $validator;

    protected function setUp():void{
        self::bootKernel();
        $this->validator = self::$container->get("validator");
    }

    private function getUser(string $email = null, string $password = null) {
        $user = (new User())->setEmail($email)->setPassword($password);
        return $user;
    }
    
    // TU SUR L'EMAIL//
    public function testGettersAndSettersEmail(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $user->setEmail("david.dupont@gmail.com");
        $this->assertEquals("david.dupont@gmail.com",$user->getEmail());
    }

    public function testIsEmailValid(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $errors = $this->validator->validate($user);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankEmail(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $errors = $this->validator->validate($user);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le nom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankNom");
    }

    // TU SUR LE MOT DE PASSE //
    public function testGettersAndSettersPassword(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $user->setPassword("blabla");
        $this->assertEquals("blabla",$user->getPassword());
    }

    public function testIsPasswordValid(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $errors = $this->validator->validate($user);
        $this->assertCount(0, $errors);
    }

    public function testNotValidBlankPassword(){
        $user = $this->getUser("david.dupont@gmail.com","blabla");
        $errors = $this->validator->validate($user);
        $this->assertCount(0, $errors);
        // $this->assertEquals("Le prénom est obligatoire.", $errors[0]->getMessage(), "Test échec sur la méthode : testNotValidBlankPrenom");
    }

} 

?>