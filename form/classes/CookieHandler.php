<?php

class CookieHandler {
    private $login;
    private $password;

    public function __construct() {
        $this->login = isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
        $this->password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
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
        return $this->login;
    }
}
?>