<?php

$_SESSION = array();
session_destroy();
?>

<script>
    function logout() {

        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "PHPSESSID=; expires=Mon, 01 May 2024 00:00:00 UTC; path=/;";

        window.location.href = "/";
    }
    logout();
</script>