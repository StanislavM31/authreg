<?php

class userDbHandler
{
    private $dbJsonPath = __DIR__ . '/../db.json';

    private function getAllUsers()
    {
        $data = file_get_contents($this->dbJsonPath);
        return json_decode($data, true);
    }

    public function getUserByUsername($login)
    {
        $allUsers = $this->getAllUsers();
        $usersCount = count($allUsers);

        for ($i = 0; $i < $usersCount; $i++) {
            $tempUser = $allUsers[$i];

            if ($tempUser['login'] === $login) {
/*                 error_log('$tempUser[login] === $login: ' . print_r($tempUser['login'], true)); */
                return true;
            }
        }
        return false;
    }

    private function checkPassword($login, $password)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['login'] === $login) {
                if ($user['password'] === $password) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return false;
    }

    public function authenticateUser($login, $password)
    {
        if ($this->getUserByUsername($login)) {
            if ($this->checkPassword($login, $password)) {
                return 'success';
            } else {
                return 'error password';
            }
        } else {
            return 'no user';
        }
    }

    public function giveMeSessionID($login)
    {
        $allUsers = $this->getAllUsers();

        foreach ($allUsers as $user) {
            if ($user['login'] === $login) {
                return $user['session_id'];
                exit();
            }
        }

    }

    public function createUser()
    {
    }

    public function updateUser($login)
    {
    }

    public function deleteUser($login)
    {
    }
}
