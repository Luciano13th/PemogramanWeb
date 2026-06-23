<?php
session_start();

require_once __DIR__ . "/database.php";
require_once __DIR__ . "/users.php";

$username = $_POST['input_username'] ?? '';
$password = $_POST['input_password'] ?? '';

$db = new Database();
$conn = $db->connect(); 

$user = new Users($conn);

$ditemukan = $user->login($username, $password);

if ($ditemukan == false) {
    $_SESSION['pesan_kesalahan'] = "login gagal";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['is_logged_in'] = true;
    $_SESSION['username'] = $username;

if (!isset($_SESSION['user_logins'])){
    $_SESSION['user_logins'] = [];
}

if (isset($_SESSION['user_logins'][$username])){
    $_SESSION['user_logins'][$username]++;
} else {
    $_SESSION['user_logins'][$username] = 1;
}

$_SESSION['login_count'] = $_SESSION['user_logins'][$username];

    header("Location: dashboard/index.php");
    exit();



    echo "<h4>Username atau password salah!</h4>";

}
?>