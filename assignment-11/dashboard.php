<?php
require_once 'session_manager.php';

if (!validateSession($pdo)) {
    header('Location: login.php?msg=expired');
    exit;
}

$username = $_SESSION['username'];
$sessions = getActiveSessions($pdo, $username);
$remaining = time() - $_SESSION['last_activity'];
$timeLeft = SESSION_TIMEOUT - $remaining;
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title>
<style>
  body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 30px; }
  .container { max-width: 700px; margin: auto; }
  .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); margin-bottom: 20px; }
  h2 { color: #2c3e50; }
  .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; background: #27ae60; color: white; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; }
  th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
  th { background: #f8f9fa; color: #555; }
  .timer { font-size: 28px; font-weight: bold; color: #e67e22; }
  a.btn { display: inline-block; padding: 10px 20px; background: #e74c3c; color: white; text-decoration: none; border-radius: 6px; margin-top: 10px; }
</style>
<meta http-equiv="refresh" content="30">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>Welcome, <?= htmlspecialchars($username) ?> <span class="badge">● Active</span></h2>
    <p>You are logged in successfully. Session will expire after 5 minutes of inactivity.</p>
    <div class="timer">⏱ <?= gmdate('i:s', max(0, $timeLeft)) ?> remaining</div>
  </div>
  <div class="card">
    <h3>Active Sessions (<?= count($sessions) ?>/<?= MAX_SESSIONS ?>)</h3>
    <table>
      <tr><th>#</th><th>Session ID</th><th>Last Activity</th></tr>
      <?php foreach ($sessions as $i => $s): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><?= substr($s['session_id'], 0, 20) ?>...</td>
        <td><?= $s['last_activity'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <a href="logout.php" class="btn">Logout</a>
</div>
</body>
</html>
