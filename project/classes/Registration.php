<?php

require_once 'classes/UserDbHandler.php';
require_once 'classes/Crypto.php';



class Registration
{
    private $login;
    private $password;
    private $confirmPassword;
    private $email;
    private $session_id;

    public function __construct($login, $password, $confirmPassword, $email, $session_id)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
        $this->session_id = $session_id;
    }

    public function register()
    {
        $userDbHandler = new UserDbHandler();

        if ($this->password !== $this->confirmPassword) {
            return 'Пароли не совпадают';
        }
        if ($userDbHandler->getUserByEmail($this->email)) {
            return 'Пользователь с таким email уже зарегистрирован';
        }
        if (strlen($this->password) < 3) {
            return 'Пароль должен быть не менее 3 символов';
        }
        if (empty($this->login) || empty($this->password) || empty($this->confirmPassword) || empty($this->email)) {
            return 'Все поля должны быть заполнены';
        }
        if (trim($this->login) === '' || trim($this->password) === '' || trim($this->confirmPassword) === '' || trim($this->email) === '') {
            return 'Не используйте пробелы для заполнения полей';
        }

        $crypto = new Crypto();

        $userRegisterResult = $userDbHandler->createUser($this->login, $crypto->hashPassword($this->password), $this->email, $this->session_id);


        return $userRegisterResult;
    }
}
