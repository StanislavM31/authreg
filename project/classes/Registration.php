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

    public function __construct($login, $password, $confirmPassword, $email, $name, $session_id)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->email = $email;
        $this->name = $name;
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
        if ($userDbHandler->getUserByUsername($this->login)) {
            return 'Пользователь с таким именем уже зарегистрирован';
        }
/*         if (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).{6,}$/', $this->password)) {
            return 'Пароль должен содержать не менее 6 символов, включая как минимум одну цифру, одну букву и один специальный символ.';
        } */
        if (strpos($this->password, ' ') !== false) {
            return 'Пароль не должен содержать пробелы';
        }
        if (empty($this->login) || empty($this->password) || empty($this->confirmPassword) || empty($this->email)) {
            return 'Все поля должны быть заполнены';
        }
        if (trim($this->login) === '' || trim($this->password) === '' || trim($this->confirmPassword) === '' || trim($this->email) === '') {
            return 'Не используйте пробелы для заполнения полей';
        }
        if (strpos($this->password, ' ') !== false) {
            return 'Пароль не должен содержать пробелы';
        }
        if (strpos($this->email, '.') === false && strpos($this->email, '@') !== false) {
            return 'Адрес электронной почты должен содержать точку в доменной части';
        }
        if (!preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}\b/', $this->email)) {
            return 'Адрес электронной почты должен быть в формате admin@mail.ru';
        }

        $crypto = new Crypto();

        $userRegisterResult = $userDbHandler->createUser($this->login, $crypto->hashPassword($this->password), $this->email, $this->name, $this->session_id);


        return $userRegisterResult;
    }
}
