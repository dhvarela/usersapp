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
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{

    public function testInMemoryUserRepository()
    {
        $ff = new FileFinder();
        $fileUrl = $ff->findFile($ff->filename());

        $inMemoryUserRepo = new InMemoryUserRepository($fileUrl);

        $inMemoryUserRepo->openFile();

        $this->assertEquals($fileUrl, $inMemoryUserRepo->fileUrl());
        $this->assertTrue($inMemoryUserRepo->hasFile());
        $this->assertNotFalse($inMemoryUserRepo->file());
    }

    public function testAddUsersInMemoryUserRepository()
    {
        $data = [[
                'email' => "tango@mailinator.com",
                'pass' => "qwerty"
            ], [
                'email' => "hotel@mailinator.com",
                'pass' => "098765"
            ]];

        $ff = new FileFinder();
        $fileUrl = $ff->findFile($ff->filename());

        $inMemoryUserRepo = new InMemoryUserRepository($fileUrl);

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
}