<?php
require_once 'db.php'; session_start();
if (!isset($_SESSION['student'])) { header('Location: student_login.php'); exit; }
$student = $_SESSION['student'];
$message = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);
    if (empty($subject) || empty($description)) {
        $error = 'All fields are required.';
    } else {
        $pdo->prepare("INSERT INTO complaints (student_id, category, subject, description) VALUES (?,?,?,?)")
            ->execute([$student['id'], $category, $subject, $description]);
        $message = 'Complaint submitted successfully!';
    }
}

$complaints = $pdo->prepare("SELECT * FROM complaints WHERE student_id=? ORDER BY created_at DESC");
$complaints->execute([$student['id']]);
$myComplaints = $complaints->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><title>File Complaint</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; margin: 0; padding: 30px; }
nav { background: #1e293b; color: white; padding: 15px 25px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
nav h2 { margin: 0; font-size: 20px; }
nav a { color: #93c5fd; text-decoration: none; font-size: 14px; }
.card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 25px; }
h3 { margin-top: 0; color: #1e293b; }
label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 5px; }
select, input[type=text], textarea { width: 100%; padding: 10px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; margin-bottom: 16px; box-sizing: border-box; font-family: inherit; }
select:focus, input:focus, textarea:focus { border-color: #3b82f6; outline: none; }
textarea { height: 120px; resize: vertical; }
button { background: #1e40af; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-size: 15px; cursor: pointer; }
.msg { padding: 12px; border-radius: 8px; margin-bottom: 20px; }
.success { background: #dcfce7; color: #166534; }
.error { background: #fee2e2; color: #dc2626; }
table { width: 100%; border-collapse: collapse; }
th { background: #f8fafc; padding: 12px; text-align: left; font-size: 13px; color: #475569; border-bottom: 2px solid #e2e8f0; }
td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
.badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
.pending { background: #fef9c3; color: #854d0e; }
.in_review { background: #dbeafe; color: #1e40af; }
.resolved { background: #dcfce7; color: #166534; }
.rejected { background: #fee2e2; color: #dc2626; }
</style>
</head>
<body>
<nav>
  <h2>🎓 <?= htmlspecialchars($student['name']) ?> | <?= htmlspecialchars($student['roll_no']) ?></h2>
  <a href="logout.php">Logout</a>
</nav>

<div class="card">
  <h3>📝 File New Complaint</h3>
  <?php if ($message): ?><div class="msg success">✅ <?= htmlspecialchars($message) ?></div><?php endif; ?>
  <?php if ($error): ?><div class="msg error">❌ <?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <label>Category</label>
    <select name="category">
      <option>Infrastructure</option><option>Faculty</option><option>Administration</option>
      <option>Library</option><option>Hostel</option><option>Canteen</option><option>Other</option>
    </select>
    <label>Subject</label>
    <input type="text" name="subject" placeholder="Brief subject of complaint" required>
    <label>Description</label>
    <textarea name="description" placeholder="Describe your complaint in detail..." required></textarea>
    <button type="submit">Submit Complaint</button>
  </form>
</div>

<div class="card">
  <h3>📋 My Complaints (<?= count($myComplaints) ?>)</h3>
  <table>
    <tr><th>Date</th><th>Category</th><th>Subject</th><th>Status</th><th>Remarks</th></tr>
    <?php if (empty($myComplaints)): ?>
    <tr><td colspan="5" style="text-align:center;padding:30px;color:#999">No complaints filed yet.</td></tr>
    <?php else: ?>
    <?php foreach ($myComplaints as $c): ?>
    <tr>
      <td><?= date('d M Y', strtotime($c['created_at'])) ?></td>
      <td><?= htmlspecialchars($c['category']) ?></td>
      <td><?= htmlspecialchars($c['subject']) ?></td>
      <td><span class="badge <?= $c['status'] ?>"><?= str_replace('_', ' ', ucfirst($c['status'])) ?></span></td>
      <td><?= htmlspecialchars($c['admin_remarks'] ?? '—') ?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
  </table>
</div>
</body>
</html>
