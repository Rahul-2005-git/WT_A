<?php
require_once 'db.php'; session_start();
if (isset($_SESSION['admin'])) { header('Location: admin_complaints.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->execute([trim($_POST['username'])]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin && password_verify($_POST['password'], $admin['password'])) { $_SESSION['admin'] = $admin; header('Location: admin_complaints.php'); exit; }
    $error = 'Invalid credentials.';
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Login</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
.card { background: white; padding: 40px; border-radius: 16px; width: 380px; box-shadow: 0 20px 60px rgba(0,0,0,0.4); }
h2 { text-align: center; color: #1e293b; margin-bottom: 25px; }
input { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; box-sizing: border-box; }
input:focus { border-color: #0f172a; outline: none; }
button { width: 100%; padding: 13px; background: #0f172a; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
.error { background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px; }
.links { text-align: center; margin-top: 15px; font-size: 14px; }
.links a { color: #0f172a; text-decoration: none; }
</style>
</head>
<body>
<div class="card">
  <h2>🔐 Admin Login</h2>
  <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <input type="text" name="username" placeholder="Admin username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Admin Login</button>
  </form>
  <div class="links">Demo: admin / teacher123 | <a href="student_login.php">Student Login</a></div>
</div>
</body>
</html>
