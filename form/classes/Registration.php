<?php

class Registration {
    private $username;
    private $password;
    private $confirmPassword;
    private $email;
    
    public function __construct($username, $password, $confirmPassword, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
    }
    
    public function register() {
        if ($this->password !== $this->confirmPassword) {
            return 'Пароли не совпадают';
        }

        $user = [
            'username' => $this->username,
            //'password' => $this->hashPassword($this->password),
            'password' => $this->password,
            'email' => $this->email
        ];
        
        $users = $this->getAllUsers();
        $users[] = $user;
        
        $this->saveUser($users);

        return true;
    }
    
/*     private function hashPassword($password) {
        
        return password_hash($password, PASSWORD_DEFAULT);
    } */

    private function getAllUsers() {
        $data = file_get_contents('db.json');
        $users = json_decode($data, true) ?? [];

        return $users;
    }

    private function saveUser($users) {
        file_put_contents('db.json', json_encode($users, JSON_PRETTY_PRINT));
    }
}

?>