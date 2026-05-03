<?php
require_once 'db.php';
session_start();
$message = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll_no = trim($_POST['roll_no']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $class = trim($_POST['class']);

    if (empty($roll_no) || empty($name) || empty($email) || empty($password) || empty($class)) {
        $error = 'All fields are required.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO students (roll_no, name, email, password, class) VALUES (?,?,?,?,?)");
            $stmt->execute([$roll_no, $name, $email, $hash, $class]);
            $message = 'Registration successful! <a href="student_login.php">Login here</a>';
        } catch (PDOException $e) {
            $error = 'Roll No or Email already exists.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Student Registration</title>
<style>
  * { box-sizing: border-box; }
  body { font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
  .card { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 100%; max-width: 450px; }
  h2 { text-align: center; color: #4a5568; margin: 0 0 30px; font-size: 24px; }
  label { display: block; font-size: 13px; font-weight: 600; color: #666; margin-bottom: 5px; }
  input, select { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; outline: none; transition: border-color 0.2s; }
  input:focus, select:focus { border-color: #667eea; }
  button { width: 100%; padding: 14px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; }
  .msg { padding: 12px; border-radius: 8px; margin-bottom: 15px; text-align: center; }
  .success { background: #c6f6d5; color: #276749; }
  .error { background: #fed7d7; color: #9b2c2c; }
  .links { text-align: center; margin-top: 20px; font-size: 14px; }
  .links a { color: #667eea; text-decoration: none; }
</style>
</head>
<body>
<div class="card">
  <h2>🎓 Student Registration</h2>
  <?php if ($message): ?><div class="msg success"><?= $message ?></div><?php endif; ?>
  <?php if ($error): ?><div class="msg error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <label>Roll Number</label>
    <input type="text" name="roll_no" placeholder="e.g. CS004" required>
    <label>Full Name</label>
    <input type="text" name="name" placeholder="Your full name" required>
    <label>Email</label>
    <input type="email" name="email" placeholder="your@email.com" required>
    <label>Class</label>
    <input type="text" name="class" placeholder="e.g. CS-3A" required>
    <label>Password</label>
    <input type="password" name="password" placeholder="Choose a strong password" required>
    <button type="submit">Register</button>
  </form>
  <div class="links">
    Already registered? <a href="student_login.php">Login</a> |
    <a href="teacher_login.php">Teacher Login</a>
  </div>
</div>
</body>
</html>
