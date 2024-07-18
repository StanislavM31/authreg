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

    private function checkPassword($login, $hashedPassword)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['login'] === $login) {
                if ($user['password'] === $hashedPassword) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return false;
    }

    public function authenticateUser($login, $hashedPassword)
    {
        if ($this->getUserByUsername($login)) {
            if ($this->checkPassword($login, $hashedPassword)) {
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
                /* exit(); */
            }
        }
    }

    public function createUser($login, $hashedPassword, $email, $name, $session_id)
    {
        date_default_timezone_set('Europe/Moscow');
        $data = file_get_contents($this->dbJsonPath);
        

        $users = json_decode($data, true) ?? [];

        $user = [
            'login' => $login,
            'password' => $hashedPassword,
            'email' => $email,
            'name' => $name,
            'session_id' => $session_id,
            'last_visited' => date('Y-m-d H:i:s'),

        ];

        $users[] = $user;

        /* file_put_contents($this->dbJsonPath, json_encode($users, JSON_PRETTY_PRINT)); */
        file_put_contents($this->dbJsonPath, json_encode($users, JSON_PRETTY_PRINT));
        
        return true;

    }
    
    public function getUserByEmail($email)
    {
        $allUsers = $this->getAllUsers();
        $usersCount = count($allUsers);

        for ($i = 0; $i < $usersCount; $i++) {
            $tempUser = $allUsers[$i];

            if ($tempUser['email'] === $email) {
                return true;
            }
        }
        return false;
    }
    public function updateUser($login)
    {
        date_default_timezone_set('Europe/Moscow');

        $allUsers = $this->getAllUsers();
        $usersCount = count($allUsers);

        for ($i = 0; $i < $usersCount; $i++) {
            $tempUser = $allUsers[$i];

            if ($tempUser['login'] === $login) {
                $updatedUser = array_replace($tempUser, ['last_visited' => date('Y-m-d H:i:s')]);
                $allUsers[$i] = $updatedUser;
                file_put_contents($this->dbJsonPath, json_encode($allUsers, JSON_PRETTY_PRINT));
                return true;
            }
        }

        return false;
    }

    public function deleteUser($session_id)
    {
        $allUsers = $this->getAllUsers();

        foreach ($allUsers as $key => $user) {
            if ($user['session_id'] === $session_id) {
                array_splice($allUsers, $key, 1);
                file_put_contents($this->dbJsonPath, json_encode($allUsers, JSON_PRETTY_PRINT));
                return true;
            }
        }

        return false;
    }
}
