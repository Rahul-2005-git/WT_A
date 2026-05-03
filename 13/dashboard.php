<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$user = $_SESSION['user'];
$cookieActive = isset($_COOKIE['remember_token']);

$stmt = $pdo->prepare("SELECT last_login FROM users WHERE id=?");
$stmt->execute([$user['id']]);
$info = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(to right, #302b63, #24243e, #0f0c29); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 30px; }
  .card { background: rgba(255,255,255,0.07); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; width: 100%; max-width: 500px; color: white; }
  h2 { font-size: 26px; margin-bottom: 5px; }
  .sub { color: rgba(255,255,255,0.5); margin-bottom: 30px; }
  .info-grid { display: grid; gap: 15px; margin-bottom: 25px; }
  .info-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 16px; }
  .info-item .label { font-size: 12px; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
  .info-item .value { font-size: 16px; font-weight: 600; }
  .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }
  .active { background: rgba(52,211,153,0.2); color: #6ee7b7; border: 1px solid rgba(52,211,153,0.3); }
  .inactive { background: rgba(248,113,113,0.2); color: #fca5a5; border: 1px solid rgba(248,113,113,0.3); }
  a.btn { display: inline-block; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 600; margin-right: 10px; }
  .btn-logout { background: rgba(248,113,113,0.2); color: #fca5a5; border: 1px solid rgba(248,113,113,0.3); }
</style>
</head>
<body>
<div class="card">
  <h2>👋 Hello, <?= htmlspecialchars($user['fullname']) ?>!</h2>
  <p class="sub">You are successfully logged in.</p>
  <div class="info-grid">
    <div class="info-item"><div class="label">Username</div><div class="value">@<?= htmlspecialchars($user['username']) ?></div></div>
    <div class="info-item"><div class="label">Email</div><div class="value"><?= htmlspecialchars($user['email']) ?></div></div>
    <div class="info-item"><div class="label">Last Login</div><div class="value"><?= $info['last_login'] ?? 'N/A' ?></div></div>
    <div class="info-item">
      <div class="label">Remember-Me Cookie</div>
      <div class="value">
        <?php if ($cookieActive): ?>
          <span class="badge active">🍪 Active (30 days)</span>
        <?php else: ?>
          <span class="badge inactive">Not set</span>
        <?php endif; ?>
      </div>
    </div>
    <div class="info-item">
      <div class="label">Session Status</div>
      <div class="value"><span class="badge active">✅ Active Session</span></div>
    </div>
  </div>
  <a href="logout.php" class="btn btn-logout">Logout</a>
  <a href="logout.php?clear_cookie=1" class="btn btn-logout">Logout & Clear Cookie</a>
</div>
</body>
</html>
