<?php

namespace Dhv\Domain\Model\User;

use Dhv\Domain\Services\UserOperations;
use PHPUnit\Framework\TestCase;

class ModelUserTest extends TestCase
{

    public function testModelUser()
    {
        $data = [
            'email' => "tango@mailinator.com",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);

        $this->assertEquals($data['email'], $user->email());
        $this->assertEquals($data['pass'], $user->password());
    }

    public function testChangePassword()
    {
        $data = [
            'email' => "tango@mailinator.com",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);

        $newPass = "123456";
        $user->changePassword($newPass);

        $this->assertEquals($newPass, $user->password());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testChangeEmptyPassword()
    {
        $data = [
            'email' => "tango@mailinator.com",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);

        $newPass = " ";
        $user->changePassword($newPass);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetInvalidEmail()
    {
        $data = [
            'email' => " ",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);
    }

    public function testEncryptPassword()
    {
        $data = [
            'email' => "tango@mailinator.com",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);

        $userOps = new UserOperations();
        $encPass = $userOps->encryptPassword($data['pass']);
        $user->changePassword($encPass);

        $this->assertFalse($user->password()=="qwerty");
        $this->assertEquals($user->password(), md5("qwerty"));
    }

}