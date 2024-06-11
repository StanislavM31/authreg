<?php

class userDbHandler
{
    private $dbFilePath = '../db.json';

    public function getUserByUsername($username)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }

        return null; // Пользователь не найден
    }
    
    public function authenticateUser($login, $password)
    {
        $data = file_get_contents('../db.json');
        $users = json_decode($data, true);

        foreach ($users as $userData) {
            if ($userData['login'] === $login && $userData['password'] === $password) {
                session_start();
                $_SESSION['login'] = $userData['login'];
                return $userData;
            }
        }

        return null;
    }

    public function getAllUsers()
    {

        $userData = json_decode(file_get_contents($this->dbFilePath), true);
        return $userData;
    }

    public function createUser($userData)
    {
    
    }

    public function updateUser($userId, $userData)
    {

    }

    public function deleteUser($userId)
    {
        // Логика удаления пользователя
    }
}
?>