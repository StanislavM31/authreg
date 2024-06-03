<?php

class User {
    private $username;
    private $password;
    private $email;
    
    public function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
}

class UserDbHandler extends User {
    public function save() {
        $data = file_get_contents('db.json');
        $users = json_decode($data, true);

        $user = [
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail()
        ];

        $users[] = $user;

        file_put_contents('db.json', json_encode($users, JSON_PRETTY_PRINT));
    }

    public static function getAllUsers() {
        $data = file_get_contents('db.json');
        $users = json_decode($data, true);

        return $users;
    }
}

?>