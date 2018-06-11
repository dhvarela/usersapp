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
    /**
     * @dataProvider getFakeUsers
     */
    public function testAddUsersInMemoryUserRepository($email, $pass)
    {
        $inMemoryUserRepo = new InMemoryUserRepository();

        $user = new ModelUser($email, $pass);
        $inMemoryUserRepo->addUser($user);

        $this->assertCount(1,$inMemoryUserRepo->users());

        $userAfinded = $inMemoryUserRepo->findByEmail($email);
        $this->assertEquals($user, $userAfinded);

        $userNotFound = $inMemoryUserRepo->findByEmail("inventado@mailinator.com");
        $this->assertFalse($userNotFound);

        $userFinded = $inMemoryUserRepo->findByEmailAndPass($email,$pass);
        $this->assertEquals($user, $userFinded);

        $userAndPassNotFound = $inMemoryUserRepo->findByEmailAndPass("inventado2@mailinator.com","zxcvzxcv");
        $this->assertFalse($userAndPassNotFound);
    }

    public function getFakeUsers()
    {
        yield [
            'email' => "tango@mailinator.com",
            'pass' => "qwerty"
        ];
        yield [
            'email' => "hotel@mailinator.com",
            'pass' => "098765"
        ];

    }

    public function testUpdateUserInRepository()
    {
        $data = ["tango@mailinator.com", "pass"];

        $inMemoryUserRepo = new InMemoryUserRepository();

        $user = new ModelUser($data[0],$data[1]);
        $inMemoryUserRepo->addUser($user);

        $user->changePassword("newpass");

        $inMemoryUserRepo->updateUserPassword($user);

        $this->assertCount(1,$inMemoryUserRepo->users());

        $userDfinded = $inMemoryUserRepo->findByEmailAndPass($data[0],"newpass");
        $this->assertEquals($user, $userDfinded);

    }

    public function testUpdateUserInRepositoryFails()
    {
        $data = ["tango@mailinator.com", "pass"];

        $inMemoryUserRepo = new InMemoryUserRepository();

        $user = new ModelUser($data[0],$data[1]);
        $user->changePassword("newpass");

        $updated = $inMemoryUserRepo->updateUserPassword($user);

        $this->assertFalse($updated);
    }
}