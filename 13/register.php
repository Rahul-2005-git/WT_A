<?php
require_once 'db.php';
session_start();
if (isset($_SESSION['user'])) { header('Location: dashboard.php'); exit; }

$message = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?,?,?,?)")
                ->execute([$fullname, $email, $username, $hash]);
            $message = 'Registration successful! <a href="login.php">Login now</a>';
        } catch (PDOException $e) {
            $error = 'Email or username already taken.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', system-ui, sans-serif; background: #0f0c29; background: linear-gradient(to right, #302b63, #24243e, #0f0c29); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
  .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); padding: 40px; border-radius: 20px; width: 100%; max-width: 440px; color: white; }
  h2 { font-size: 26px; font-weight: 700; margin-bottom: 8px; }
  .sub { color: rgba(255,255,255,0.5); font-size: 14px; margin-bottom: 30px; }
  .form-group { margin-bottom: 18px; }
  label { display: block; font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
  input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: white; font-size: 15px; outline: none; transition: border-color 0.2s; }
  input::placeholder { color: rgba(255,255,255,0.3); }
  input:focus { border-color: #a78bfa; }
  button { width: 100%; padding: 14px; background: linear-gradient(135deg, #a78bfa, #7c3aed); border: none; border-radius: 10px; color: white; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; transition: opacity 0.2s; }
  button:hover { opacity: 0.9; }
  .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
  .alert-success { background: rgba(52, 211, 153, 0.2); color: #6ee7b7; border: 1px solid rgba(52,211,153,0.3); }
  .alert-error { background: rgba(248, 113, 113, 0.2); color: #fca5a5; border: 1px solid rgba(248,113,113,0.3); }
  .link { text-align: center; margin-top: 20px; font-size: 14px; color: rgba(255,255,255,0.5); }
  .link a { color: #a78bfa; text-decoration: none; font-weight: 600; }
</style>
</head>
<body>
<div class="card">
  <h2>Create Account</h2>
  <p class="sub">Join us today, it's free!</p>
  <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
  <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <div class="form-group"><label>Full Name</label><input type="text" name="fullname" placeholder="John Doe" required></div>
    <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="you@example.com" required></div>
    <div class="form-group"><label>Username</label><input type="text" name="username" placeholder="johndoe" required></div>
    <div class="form-group"><label>Password</label><input type="password" name="password" placeholder="Min. 6 characters" required></div>
    <div class="form-group"><label>Confirm Password</label><input type="password" name="confirm_password" placeholder="Repeat password" required></div>
    <button type="submit">Create Account</button>
  </form>
  <div class="link">Already have an account? <a href="login.php">Sign in</a></div>
</div>
</body>
</html>
