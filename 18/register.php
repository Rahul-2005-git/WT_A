<?php
require_once 'db.php'; session_start();
$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']); $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']); $pass = $_POST['password'];
    if (empty($name)||empty($email)||empty($mobile)||empty($pass)) { $error='All fields required.'; }
    else {
        try {
            $pdo->prepare("INSERT INTO users (name,email,mobile,password) VALUES (?,?,?,?)")
                ->execute([$name,$email,$mobile,password_hash($pass,PASSWORD_BCRYPT)]);
            $success = 'Registered! <a href="login.php">Login now</a>';
        } catch(PDOException $e){ $error='Email already registered.'; }
    }
}
?>
<!DOCTYPE html><html>
<head><title>Register - Complaint Portal</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#1e3a5f,#2d6a4f);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:white;padding:40px;border-radius:16px;width:100%;max-width:440px;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
h2{text-align:center;color:#1e3a5f;margin-bottom:25px;font-size:24px}
label{display:block;font-size:12px;font-weight:700;color:#555;text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px}
input{width:100%;padding:12px;border:2px solid #e2e8f0;border-radius:8px;font-size:15px;margin-bottom:16px}
input:focus{border-color:#1e3a5f;outline:none}
button{width:100%;padding:13px;background:#1e3a5f;color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer}
.msg{padding:12px;border-radius:8px;margin-bottom:15px;text-align:center;font-size:14px}
.success{background:#dcfce7;color:#166534}
.error{background:#fee2e2;color:#dc2626}
.links{text-align:center;margin-top:15px;font-size:14px}
.links a{color:#1e3a5f;text-decoration:none;font-weight:600}
</style></head><body>
<div class="card">
  <h2>📋 Create Account</h2>
  <?php if($success):?><div class="msg success"><?=$success?></div><?php endif;?>
  <?php if($error):?><div class="msg error"><?=htmlspecialchars($error)?></div><?php endif;?>
  <form method="post">
    <label>Full Name</label><input type="text" name="name" placeholder="Your full name" required>
    <label>Email</label><input type="email" name="email" placeholder="your@email.com" required>
    <label>Mobile</label><input type="tel" name="mobile" placeholder="10-digit mobile" required>
    <label>Password</label><input type="password" name="password" placeholder="Min 6 characters" required>
    <button type="submit">Register</button>
  </form>
  <div class="links">Already have account? <a href="login.php">Login</a></div>
</div></body></html>
