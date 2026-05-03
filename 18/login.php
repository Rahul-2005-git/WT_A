<?php
require_once 'db.php'; session_start();
if(isset($_SESSION['user'])){header('Location: complaint.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([trim($_POST['email'])]);
    $u=$stmt->fetch(PDO::FETCH_ASSOC);
    if($u&&password_verify($_POST['password'],$u['password'])){$_SESSION['user']=$u;header('Location: complaint.php');exit;}
    $error='Invalid credentials.';
}
?>
<!DOCTYPE html><html>
<head><title>Login - Complaint Portal</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',sans-serif;background:linear-gradient(135deg,#1e3a5f,#2d6a4f);min-height:100vh;display:flex;align-items:center;justify-content:center}
.card{background:white;padding:40px;border-radius:16px;width:380px;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
h2{text-align:center;color:#1e3a5f;margin-bottom:25px}
label{display:block;font-size:12px;font-weight:700;color:#555;text-transform:uppercase;margin-bottom:5px}
input{width:100%;padding:12px;border:2px solid #e2e8f0;border-radius:8px;font-size:15px;margin-bottom:16px;box-sizing:border-box}
input:focus{border-color:#1e3a5f;outline:none}
button{width:100%;padding:13px;background:#1e3a5f;color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer}
.error{background:#fee2e2;color:#dc2626;padding:10px;border-radius:8px;margin-bottom:15px;text-align:center;font-size:14px}
.links{text-align:center;margin-top:15px;font-size:14px}
.links a{color:#1e3a5f;text-decoration:none;font-weight:600}
.demo{background:#f0f9ff;border:1px solid #bae6fd;padding:12px;border-radius:8px;font-size:13px;color:#0369a1;margin-bottom:15px;text-align:center}
</style></head><body>
<div class="card">
  <h2>🔐 Citizen Login</h2>
  <?php if($error):?><div class="error"><?=htmlspecialchars($error)?></div><?php endif;?>
  <div class="demo">Register a new account to get started</div>
  <form method="post">
    <label>Email</label><input type="email" name="email" placeholder="your@email.com" required>
    <label>Password</label><input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="links">New user? <a href="register.php">Register</a></div>
</div></body></html>
