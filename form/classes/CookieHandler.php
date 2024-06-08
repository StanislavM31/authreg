<?php

class CookieHandler {
    public $login;
    public $password;

    public function __construct() {
        $this->login = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
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