<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 14:49
 */

namespace Dhv\Infrastructure\Persistence\InMemory\User;

use Dhv\Domain\Model\User\ModelUser;

class InMemoryUserRepository
{
    /**
     * @string
     */
    private $fileUrl;

    /**
     * @var ModelUser[]
     */
    private $users = array();

    /**
     * @file
     */
    private $file = array();

    /**
     * @param string $fileUrl
     */
    public function __construct($fileUrl)
    {
        $this->fileUrl = $fileUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmail($email)
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email) {
                return $user;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmailAndPass($email, $password)
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email && $user->password() == $password) {
                return $user;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function addUser(ModelUser $user)
    {
        $this->users[] = $user;
    }

    public function openFile()
    {
        $this->file = fopen($this->fileUrl, "r");
    }

    public function file()
    {
        return $this->file;
    }

    public function fileUrl()
    {
        return $this->fileUrl;
    }

    public function hasFile()
    {
        return $this->file() ? true : false;
    }

}
