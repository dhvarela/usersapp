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
     * @var ModelUser[]
     */
    private $users = array();

    /**
     * {@inheritdoc}
     */
    public function findByEmail($email)
    {
        foreach ($this->users as $user) {
            if ($user instanceof ModelUser && $user->email() === $email) {
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
     * @param ModelUser $user
     */
    public function updateUserPassword(ModelUser $user)
    {
        if ($user instanceof ModelUser) {
            foreach ($this->users as $key=>$u) {
                if ($u->email() == $user->email()) {
                    $this->users[$key] = $user;
                    return true;
                }
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

    public function users()
    {
        return $this->users;
    }

}
