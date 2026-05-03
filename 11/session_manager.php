<?php
require_once 'db.php';

define('MAX_SESSIONS', 3);
define('SESSION_TIMEOUT', 300);

function startUserSession($pdo, $username) {
    $pdo->prepare("DELETE FROM user_sessions WHERE last_activity < NOW() - INTERVAL 5 MINUTE")->execute();

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_sessions WHERE username = ?");
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();

    if ($count >= MAX_SESSIONS) {
        return ['success' => false, 'message' => "Maximum session limit ($count/3) reached. Please logout from another device."];
    }

    $token = bin2hex(random_bytes(32));
    session_start();
    session_regenerate_id(true);
    $sessionId = session_id();

    $stmt = $pdo->prepare("INSERT INTO user_sessions (username, session_id, token, last_activity) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$username, $sessionId, $token]);

    $_SESSION['username'] = $username;
    $_SESSION['token'] = $token;
    $_SESSION['last_activity'] = time();

    return ['success' => true, 'message' => "Login successful! Active sessions: " . ($count + 1) . "/3"];
}

function validateSession($pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['username'], $_SESSION['token'], $_SESSION['last_activity'])) return false;

    if (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
        destroySession($pdo);
        return false;
    }

    $stmt = $pdo->prepare("SELECT id FROM user_sessions WHERE username=? AND token=? AND last_activity > NOW() - INTERVAL 5 MINUTE");
    $stmt->execute([$_SESSION['username'], $_SESSION['token']]);
    if (!$stmt->fetch()) { destroySession($pdo); return false; }

    $_SESSION['last_activity'] = time();
    $pdo->prepare("UPDATE user_sessions SET last_activity=NOW() WHERE token=?")->execute([$_SESSION['token']]);
    return true;
}

function destroySession($pdo) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['token'])) {
        $pdo->prepare("DELETE FROM user_sessions WHERE token=?")->execute([$_SESSION['token']]);
    }
    session_unset();
    session_destroy();
}

function getActiveSessions($pdo, $username) {
    $stmt = $pdo->prepare("SELECT session_id, last_activity FROM user_sessions WHERE username=? AND last_activity > NOW() - INTERVAL 5 MINUTE");
    $stmt->execute([$username]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
