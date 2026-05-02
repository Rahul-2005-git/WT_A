<?php
require_once 'db.php';
session_start();
if (isset($_GET['clear_cookie']) || isset($_COOKIE['remember_token'])) {
    if (isset($_SESSION['user'])) {
        $pdo->prepare("UPDATE users SET remember_token=NULL WHERE id=?")->execute([$_SESSION['user']['id']]);
    }
    setcookie('remember_token', '', time() - 3600, '/');
}
session_unset();
session_destroy();
header('Location: login.php');
exit;
