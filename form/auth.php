<?php

function checkAuth(string $login, string $password)
{
    $usersJson = file_get_contents(__DIR__ . '/db.json');
    $users = json_decode($usersJson, true);

    foreach ($users as $user) {
        if ($user['login'] === $login && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function getUserLogin(): ?string
{
    if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
        $loginFromCookie = $_COOKIE['login'];
        $passwordFromCookie = $_COOKIE['password'];

        if (checkAuth($loginFromCookie, $passwordFromCookie)) {
            return $loginFromCookie;
        }
    }
    return null;
}


?>