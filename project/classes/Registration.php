<?php
require_once __DIR__ . '/UserDbHandler.php';
require_once 'classes/UserDbHandler.php';

$userDbHandler = new UserDbHandler();

class Registration {
    private $login;
    private $password;
    private $confirmPassword;
    private $email;
    private $session_id;
    
    public function __construct($login, $password, $confirmPassword, $email, $session_id) {
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
        $this->session_id = $session_id;
    }
    
    public function register() {
        if ($this->password !== $this->confirmPassword) {
            return 'Пароли не совпадают';
        }

        $user = [
            'login' => $this->login,
            //'password' => $this->hashPassword($this->password),
            'password' => $this->password,
            'email' => $this->email,
            'session_id' => $this->session_id
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