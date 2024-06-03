<?php

class CookieHandler {
    private $username;
    private $password;

    public function __construct() {
        $this->username = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
        $this->password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
    }

    public function displayCookies() {
        if ($this->username !== null || $this->password !== null) {
            echo 'Cookie username: ' . $this->username . '<br>';
            echo 'Cookie password: ' . $this->password;
        } else {
            echo 'Куки username или password отсутствуют.';
        }
    }

    public function getUsername() {
        return $this->username;
    }
}
?>