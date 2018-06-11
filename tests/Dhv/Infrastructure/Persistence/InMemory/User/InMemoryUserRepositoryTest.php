<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 22:01
 */

namespace Dhv\Infrastructure\Persistence\InMemory\User;

use Dhv\Domain\Model\User\ModelUser;
use Dhv\Domain\Services\FileFinder;
use Dhv\Domain\Services\FileOperations;
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{

    public function testAddUsersInMemoryUserRepository()
    {
        $data = [[
            'email' => "tango@mailinator.com",
            'pass' => "qwerty"
        ], [
            'email' => "hotel@mailinator.com",
            'pass' => "098765"
        ]];

        $inMemoryUserRepo = new InMemoryUserRepository();

        $userA = new ModelUser($data[0]['email'], $data[0]['pass']);
        $userB = new ModelUser($data[1]['email'], $data[1]['pass']);
        $inMemoryUserRepo->addUser($userA);
        $inMemoryUserRepo->addUser($userB);

        $this->assertCount(2,$inMemoryUserRepo->users());

        $userAfinded = $inMemoryUserRepo->findByEmail($data[0]['email']);
        $this->assertEquals($userA, $userAfinded);

        $userNotFound = $inMemoryUserRepo->findByEmail("inventado@mailinator.com");
        $this->assertFalse($userNotFound);

        $userDfinded = $inMemoryUserRepo->findByEmailAndPass($data[1]['email'],$data[1]['pass']);
        $this->assertEquals($userB, $userDfinded);

        $userAndPassNotFound = $inMemoryUserRepo->findByEmailAndPass("inventado2@mailinator.com","zxcvzxcv");
        $this->assertFalse($userAndPassNotFound);
    }

    public function testEncryptPassUserRepository()
    {
        $data = ["tango@mailinator.com", "qwerty"];

        $inMemoryUserRepo = new InMemoryUserRepository();

        $userA = new ModelUser($data[0],$data[1]);
        $inMemoryUserRepo->addUser($userA);

        $userFound = $inMemoryUserRepo->findByEmailAndPass($data[0],$data[1]);
        $inMemoryUserRepo->encryptUserPass($userFound);

    }
}