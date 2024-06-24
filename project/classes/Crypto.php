<?php

class Crypto
{
    private $salt = 3;

    public function getSalt()
    {
        return $this->salt;
    }

    public function hashPassword($password)
    {
        $saltedPassword = $this->salt . $password;
        $hashedPassword = md5($saltedPassword);
        return $hashedPassword;
    }

}
