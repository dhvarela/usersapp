<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 14:51
 */

namespace Dhv\Domain\Model\User;


class ModelUser
{
    const PASSWORD_DEFAULT = "123456";

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;


    /**
     * @param string $email
     * @param string $password
     */
    public function __construct($email, $password)
    {
        $this->setEmail($email);
        $this->changePassword($password);
    }

    /**
     * @param $email
     */
    protected function setEmail($email)
    {
        $email = trim($email);
        if (!$email) {
            throw new \InvalidArgumentException('email');
        }

        // TODO - assert the email

        $this->email = strtolower($email);
    }

    /**
     * @param string $password
     */
    public function changePassword($password)
    {
        $password = trim($password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }

        $this->password = $password;
    }

    /**
     * @param string $password
     */
    public function encryptPassword($password = null)
    {
        $password = trim($password ?? $this->password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }

        $this->changePassword(md5($password));
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }
}
