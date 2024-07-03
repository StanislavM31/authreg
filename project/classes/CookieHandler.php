<?php

class CookieHandler
{
    private $login;
    private $password;
    private $sessionId;

    public function __construct()
    {
        $this->login = isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
        $this->password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
        $this->sessionId = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : null;
    }

    public function displayCookies()
    {
        if ($this->login !== null /* && $this->password !== null && $this->sessionId !== null */) {
            echo 'Cookie username: ' . $this->login . '<br>';
            /* echo 'Cookie password: ' . $this->password . '<br>'; */
            echo 'Cookie sessionId: ' . $this->sessionId . '<br>';
            echo 'Request Method: ' . $_SERVER['REQUEST_METHOD'] . '<br>';
            echo 'Request URI: ' . $_SERVER['REQUEST_URI'] . '<br>';
        } else {
            echo 'Куки не установлены';
        }
    }


    public function getUsername()
    {
        return $this->login;
    }
}
