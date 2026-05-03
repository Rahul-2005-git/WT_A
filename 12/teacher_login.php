<?php
require_once 'db.php';
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM teachers WHERE email=?");
    $stmt->execute([$email]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($teacher && password_verify($password, $teacher['password'])) {
        $_SESSION['teacher'] = $teacher;
        header('Location: teacher_attendance.php');
        exit;
    }
    $error = 'Invalid credentials.';
}
?>
<!DOCTYPE html>
<html>
<head><title>Teacher Login</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
  .card { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 380px; }
  h2 { text-align: center; color: #4a5568; margin: 0 0 30px; }
  input { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; box-sizing: border-box; }
  input:focus { border-color: #11998e; outline: none; }
  button { width: 100%; padding: 14px; background: linear-gradient(135deg, #11998e, #38ef7d); color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: 600; }
  .error { background: #fed7d7; color: #9b2c2c; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; }
  .links { text-align: center; margin-top: 20px; font-size: 14px; }
  .links a { color: #11998e; text-decoration: none; }
</style>
</head>
<body>
<div class="card">
  <h2>👨‍🏫 Teacher Login</h2>
  <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <input type="email" name="email" placeholder="Teacher email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <div class="links">Demo: sharma@college.com / teacher123 | <a href="student_login.php">Student Login</a></div>
</div>
</body>
</html>
