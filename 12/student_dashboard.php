<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['student'])) { header('Location: student_login.php'); exit; }
$student = $_SESSION['student'];

$stmt = $pdo->prepare("SELECT a.date, a.subject, a.status, t.name as teacher FROM attendance a JOIN teachers t ON a.teacher_id=t.id WHERE a.student_id=? ORDER BY a.date DESC");
$stmt->execute([$student['id']]);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($records);
$present = count(array_filter($records, fn($r) => $r['status'] === 'present'));
$pct = $total > 0 ? round($present/$total*100) : 0;
?>
<!DOCTYPE html>
<html>
<head><title>Student Dashboard</title>
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f7fafc; margin: 0; padding: 30px; }
  .header { background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 20px 30px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
  .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; }
  .stat { background: white; padding: 20px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
  .stat h3 { font-size: 32px; margin: 0; color: #667eea; }
  .stat p { margin: 5px 0 0; color: #666; font-size: 14px; }
  table { width: 100%; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-collapse: collapse; }
  th { background: #667eea; color: white; padding: 14px; text-align: left; font-size: 14px; }
  td { padding: 12px 14px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
  .present { background: #c6f6d5; color: #276749; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
  .absent { background: #fed7d7; color: #9b2c2c; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
  .late { background: #fefcbf; color: #744210; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
  a.logout { color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 6px; }
</style>
</head>
<body>
<div class="header">
  <div>
    <h2 style="margin:0">👋 <?= htmlspecialchars($student['name']) ?></h2>
    <p style="margin:5px 0 0; opacity:0.8">Roll No: <?= htmlspecialchars($student['roll_no']) ?> | Class: <?= htmlspecialchars($student['class']) ?></p>
  </div>
  <a href="logout.php" class="logout">Logout</a>
</div>

<div class="stats">
  <div class="stat"><h3><?= $total ?></h3><p>Total Classes</p></div>
  <div class="stat"><h3 style="color:#27ae60"><?= $present ?></h3><p>Present</p></div>
  <div class="stat"><h3 style="color:<?= $pct >= 75 ? '#27ae60' : '#e74c3c' ?>"><?= $pct ?>%</h3><p>Attendance %</p></div>
</div>

<table>
  <tr><th>Date</th><th>Subject</th><th>Teacher</th><th>Status</th></tr>
  <?php if (empty($records)): ?>
  <tr><td colspan="4" style="text-align:center;color:#999;padding:30px">No attendance records yet.</td></tr>
  <?php else: ?>
  <?php foreach ($records as $r): ?>
  <tr>
    <td><?= $r['date'] ?></td>
    <td><?= htmlspecialchars($r['subject']) ?></td>
    <td><?= htmlspecialchars($r['teacher']) ?></td>
    <td><span class="<?= $r['status'] ?>"><?= ucfirst($r['status']) ?></span></td>
  </tr>
  <?php endforeach; ?>
  <?php endif; ?>
</table>
</body>
</html>
