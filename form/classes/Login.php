<?php
/* require_once __DIR__ . '/UserDbHandler.php'; */


class Login {


    public function authenticateUser($username, $password) {
        $userDbHandler = new UserDbHandler();
        $user = $userDbHandler->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            return true; 
        } else {
            return false;
        }
    }
}
?>