<?php
/**
 * Created by PhpStorm.
 * User: dhvarela
 * Date: 10/08/18
 * Time: 13:17
 */

namespace Dhv\Domain\Services;

class UserOperations
{

    public function __construct()
    {
    }

    /**
     * @param string $password
     */
    public function encryptPassword($password = null)
    {
        $password = trim($password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }

        return md5($password);
    }
}