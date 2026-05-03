<?php
require_once 'db.php';
session_start();

// Auto-login via remember_me cookie
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token=?");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['user'] = ['id'=>$user['id'],'username'=>$user['username'],'fullname'=>$user['fullname'],'email'=>$user['email']];
        header('Location: dashboard.php');
        exit;
    }
}

if (isset($_SESSION['user'])) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = ['id'=>$user['id'],'username'=>$user['username'],'fullname'=>$user['fullname'],'email'=>$user['email']];

        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (30*24*3600), '/', '', false, true);
            $pdo->prepare("UPDATE users SET remember_token=?, last_login=NOW() WHERE id=?")->execute([$token, $user['id']]);
        } else {
            $pdo->prepare("UPDATE users SET last_login=NOW() WHERE id=?")->execute([$user['id']]);
        }
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Invalid username/email or password.';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', system-ui, sans-serif; background: linear-gradient(to right, #302b63, #24243e, #0f0c29); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
  .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; color: white; }
  h2 { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
  .sub { color: rgba(255,255,255,0.5); font-size: 14px; margin-bottom: 30px; }
  .form-group { margin-bottom: 20px; }
  label { display: block; font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
  input[type=text], input[type=password] { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: white; font-size: 15px; outline: none; }
  input[type=text]:focus, input[type=password]:focus { border-color: #a78bfa; }
  input::placeholder { color: rgba(255,255,255,0.3); }
  .remember { display: flex; align-items: center; gap: 10px; font-size: 14px; color: rgba(255,255,255,0.6); }
  .remember input { width: auto; }
  button { width: 100%; padding: 14px; background: linear-gradient(135deg, #a78bfa, #7c3aed); border: none; border-radius: 10px; color: white; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 20px; }
  .alert { padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; background: rgba(248,113,113,0.2); color: #fca5a5; border: 1px solid rgba(248,113,113,0.3); }
  .link { text-align: center; margin-top: 20px; font-size: 14px; color: rgba(255,255,255,0.5); }
  .link a { color: #a78bfa; text-decoration: none; font-weight: 600; }
  .cookie-info { background: rgba(167,139,250,0.1); border: 1px solid rgba(167,139,250,0.3); border-radius: 10px; padding: 12px; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 20px; }
</style>
</head>
<body>
<div class="card">
  <h2>Welcome Back</h2>
  <p class="sub">Sign in to your account</p>
  <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <?php if (isset($_COOKIE['remember_token'])): ?>
  <div class="cookie-info">🍪 Remember-me cookie detected. Logging you in...</div>
  <?php endif; ?>
  <form method="post">
    <div class="form-group"><label>Username or Email</label><input type="text" name="username" placeholder="Enter username or email" required></div>
    <div class="form-group"><label>Password</label><input type="password" name="password" placeholder="Enter password" required></div>
    <div class="remember"><input type="checkbox" name="remember" id="rem"><label for="rem" style="text-transform:none;letter-spacing:0">Remember me for 30 days</label></div>
    <button type="submit">Sign In</button>
  </form>
  <div class="link">Don't have an account? <a href="register.php">Register</a></div>
</div>
</body>
</html>
