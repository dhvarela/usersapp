<?php
/**
 * Created by PhpStorm.
 * User: dhvarela
 * Date: 10/08/18
 * Time: 13:53
 */

namespace Dhv\Domain\Services;

use Dhv\Domain\Model\User\ModelUser;
use PHPUnit\Framework\TestCase;

class UserOperationsTest extends TestCase {

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEncryptEmptyPassword()
    {
        $userOps = new UserOperations();
        $data = [
            'email' => "tango@mailinator.com",
            'pass'  => "qwerty"
        ];
        $user = new ModelUser($data['email'],$data['pass']);

        $userOps->encryptPassword(" ");
    }


}