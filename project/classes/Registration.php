<?php

require_once 'classes/UserDbHandler.php';
require_once 'classes/Crypto.php';



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
        $userDbHandler = new UserDbHandler();
        
        if ($this->password !== $this->confirmPassword) {
            return 'Пароли не совпадают';
        }

        if ($userDbHandler->getUserByEmail($this->email) ) {
            return 'Пользователь с таким email уже есть';
        }
        
        $crypto = new Crypto();

        $userDbHandler->createUser($this->login, $crypto->hashPassword($this->password), $this->email, $this->session_id );
    
        return true;
    }
    
}

?>