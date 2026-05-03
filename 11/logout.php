<?php
require_once 'session_manager.php';
if (session_status() === PHP_SESSION_NONE) session_start();
destroySession($pdo);
header('Location: login.php?msg=loggedout');
exit;
