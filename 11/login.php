<?php
require_once 'session_manager.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password'])) {
        $result = startUserSession($pdo, $username);
        if ($result['success']) {
            header('Location: dashboard.php');
            exit;
        } else {
            $message = $result['message'];
        }
    } else {
        $message = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login - Session Manager</title>
<style>
  body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
  .card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 350px; }
  h2 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
  input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
  button { width: 100%; padding: 12px; background: #3498db; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
  button:hover { background: #2980b9; }
  .msg { padding: 10px; border-radius: 5px; margin-bottom: 15px; background: #ffe0e0; color: #c0392b; text-align: center; }
  .info { background: #e8f4fd; padding: 15px; border-radius: 6px; font-size: 13px; color: #555; margin-top: 15px; }
</style>
</head>
<body>
<div class="card">
  <h2>🔐 Secure Login</h2>
  <?php if ($message): ?><div class="msg"><?= htmlspecialchars($message) ?></div><?php endif; ?>
  <form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="info">
    <strong>Demo users:</strong> student1 / student2<br>
    <strong>Password:</strong> password<br>
    <strong>Max sessions:</strong> 3 per user<br>
    <strong>Session timeout:</strong> 5 minutes
  </div>
</div>
</body>
</html>
