<?php

namespace Dhv\UsersApp;

class User
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}