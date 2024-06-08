<?php

class CookieHandler {
    public $login;
    public $password;
    public $ssid;

    public function __construct() {
        $this->login = isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
        $this->password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
        /* $this->ssid = isset($_COOKIE); */
    }

    public function displayCookies() {
        if ($this->login !== null || $this->password !== null) {
            echo 'Cookie username: ' . $this->login . '<br>';
            echo 'Cookie password: ' . $this->password;
        } else {
            echo 'Куки username или password отсутствуют.';
        }
    }


    public function getUsername() {
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        return $this->login;
    }
}
?>