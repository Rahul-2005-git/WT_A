<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['teacher'])) { header('Location: teacher_login.php'); exit; }
$teacher = $_SESSION['teacher'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_attendance'])) {
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $present_ids = $_POST['present'] ?? [];

    $students_stmt = $pdo->query("SELECT id FROM students");
    $all_ids = $students_stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($all_ids as $sid) {
        $status = in_array($sid, $present_ids) ? 'present' : 'absent';
        $pdo->prepare("INSERT INTO attendance (student_id, teacher_id, date, subject, status) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE status=?")
            ->execute([$sid, $teacher['id'], $date, $subject, $status, $status]);
    }
    $message = "Attendance saved for $date - $subject!";
}

$students = $pdo->query("SELECT * FROM students ORDER BY roll_no")->fetchAll(PDO::FETCH_ASSOC);
$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head><title>Take Attendance</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f7fafc; margin: 0; padding: 30px; }
  .header { background: linear-gradient(135deg, #11998e, #38ef7d); color: white; padding: 20px 30px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
  .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px; }
  label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 5px; }
  input, select { width: 100%; padding: 10px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; box-sizing: border-box; }
  table { width: 100%; border-collapse: collapse; }
  th { background: #f7fafc; padding: 12px; text-align: left; font-size: 14px; color: #555; border-bottom: 2px solid #e2e8f0; }
  td { padding: 12px; border-bottom: 1px solid #f0f0f0; }
  .check-cell { text-align: center; }
  input[type=checkbox] { width: 20px; height: 20px; cursor: pointer; accent-color: #11998e; }
  .btn-submit { background: linear-gradient(135deg, #11998e, #38ef7d); color: white; border: none; padding: 14px 30px; border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: 600; margin-top: 20px; }
  .success { background: #c6f6d5; color: #276749; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; }
  .mark-all { background: #e2e8f0; border: none; padding: 6px 14px; border-radius: 6px; cursor: pointer; font-size: 13px; margin-bottom: 10px; }
  a.logout { color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 6px; }
</style>
</head>
<body>
<div class="header">
  <div>
    <h2 style="margin:0">👨‍🏫 <?= htmlspecialchars($teacher['name']) ?></h2>
    <p style="margin:5px 0 0;opacity:0.8">Subject: <?= htmlspecialchars($teacher['subject']) ?></p>
  </div>
  <a href="logout.php" class="logout">Logout</a>
</div>

<div class="card">
  <?php if ($message): ?><div class="success">✅ <?= htmlspecialchars($message) ?></div><?php endif; ?>
  <h3 style="margin-top:0">📋 Take Attendance</h3>
  <form method="post">
    <div class="form-row">
      <div><label>Date</label><input type="date" name="date" value="<?= $today ?>" required></div>
      <div><label>Subject</label>
        <select name="subject" required>
          <option>Mathematics</option><option>Physics</option><option>Chemistry</option>
          <option>Computer Science</option><option>English</option>
        </select>
      </div>
    </div>
    <button type="button" class="mark-all" onclick="markAll(true)">✅ Mark All Present</button>
    <button type="button" class="mark-all" onclick="markAll(false)">❌ Mark All Absent</button>
    <table>
      <tr><th>Roll No</th><th>Student Name</th><th>Class</th><th>Present</th></tr>
      <?php foreach ($students as $s): ?>
      <tr>
        <td><?= htmlspecialchars($s['roll_no']) ?></td>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= htmlspecialchars($s['class']) ?></td>
        <td class="check-cell"><input type="checkbox" name="present[]" value="<?= $s['id'] ?>" checked></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <button type="submit" name="submit_attendance" class="btn-submit">💾 Save Attendance</button>
  </form>
</div>

<script>
function markAll(val) {
  document.querySelectorAll('input[type=checkbox]').forEach(cb => cb.checked = val);
}
</script>
</body>
</html>
