<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Привет, " . $username;
    echo "<br><button onclick=\"logout()\">Разлогиниться</button>";
} else {
    if (isset($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
        $_SESSION['username'] = $username;
        echo "Привет, " . $username;
        echo "<br><button onclick=\"logout()\">Разлогиниться</button>";
    } else {
        echo "Error";
    }
}
?>

<script>
function logout() {
    <?php $_SESSION = array(); ?>
    <?php session_destroy(); ?>
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "PHPSESSID=; expires=Mon, 01 May 2024 00:00:00 UTC; path=/;";
    window.location.href = "/";
}
</script>