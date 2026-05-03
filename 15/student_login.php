<?php
require_once 'db.php'; session_start();
if (isset($_SESSION['student'])) { header('Location: complaint.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email=?");
    $stmt->execute([trim($_POST['email'])]);
    $s = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($s && password_verify($_POST['password'], $s['password'])) { $_SESSION['student'] = $s; header('Location: complaint.php'); exit; }
    $error = 'Invalid credentials.';
}
?>
<!DOCTYPE html>
<html>
<head><title>Student Login</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
.card { background: white; padding: 40px; border-radius: 16px; width: 380px; box-shadow: 0 8px 30px rgba(0,0,0,0.1); }
h2 { text-align: center; color: #1e293b; margin-bottom: 25px; }
input { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; box-sizing: border-box; }
input:focus { border-color: #3b82f6; outline: none; }
button { width: 100%; padding: 13px; background: #1e40af; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
.error { background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px; }
.links { text-align: center; margin-top: 15px; font-size: 14px; }
.links a { color: #1e40af; text-decoration: none; }
</style>
</head>
<body>
<div class="card">
  <h2>🎓 Student Login</h2>
  <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <input type="email" name="email" placeholder="College email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="links">
    Demo: rahul@college.com / teacher123 |
    <a href="admin_login.php">Admin Login</a>
  </div>
</div>
</body>
</html>
