<?php
require_once 'db.php'; session_start();
if (!isset($_SESSION['admin'])) { header('Location: admin_login.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_complaint'])) {
    $pdo->prepare("UPDATE complaints SET status=?, admin_remarks=? WHERE id=?")
        ->execute([$_POST['status'], $_POST['remarks'], $_POST['complaint_id']]);
    header('Location: admin_complaints.php?updated=1'); exit;
}

$filter = $_GET['filter'] ?? 'all';
$query = "SELECT c.*, s.name as student_name, s.roll_no, s.department FROM complaints c JOIN students s ON c.student_id=s.id";
if ($filter !== 'all') $query .= " WHERE c.status='$filter'";
$query .= " ORDER BY c.created_at DESC";
$complaints = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

$stats = $pdo->query("SELECT status, COUNT(*) as cnt FROM complaints GROUP BY status")->fetchAll(PDO::FETCH_ASSOC);
$statMap = ['pending'=>0,'in_review'=>0,'resolved'=>0,'rejected'=>0];
foreach ($stats as $s) $statMap[$s['status']] = $s['cnt'];
?>
<!DOCTYPE html>
<html>
<head><title>Admin - Complaints</title>
<style>
body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; margin: 0; padding: 30px; }
nav { background: #0f172a; color: white; padding: 15px 25px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
nav h2 { margin: 0; font-size: 20px; }
nav a { color: #93c5fd; text-decoration: none; font-size: 14px; }
.stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 15px; margin-bottom: 25px; }
.stat { background: white; padding: 20px; border-radius: 12px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
.stat h3 { font-size: 32px; margin: 0; }
.stat p { margin: 5px 0 0; font-size: 13px; color: #64748b; }
.filters { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
.filters a { padding: 7px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; background: white; color: #475569; box-shadow: 0 1px 5px rgba(0,0,0,0.08); }
.filters a.active { background: #0f172a; color: white; }
.card { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); overflow: hidden; }
table { width: 100%; border-collapse: collapse; }
th { background: #f8fafc; padding: 12px; text-align: left; font-size: 13px; color: #475569; border-bottom: 2px solid #e2e8f0; }
td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; vertical-align: top; }
.badge { padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
.pending { background: #fef9c3; color: #854d0e; }
.in_review { background: #dbeafe; color: #1e40af; }
.resolved { background: #dcfce7; color: #166534; }
.rejected { background: #fee2e2; color: #dc2626; }
select { padding: 5px 8px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; }
input[type=text] { padding: 5px 8px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; width: 150px; }
button.update { background: #0f172a; color: white; border: none; padding: 5px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; }
.success-msg { background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 15px; }
</style>
</head>
<body>
<nav>
  <h2>🔐 Admin Panel – Complaints</h2>
  <a href="logout.php">Logout</a>
</nav>
<?php if (isset($_GET['updated'])): ?><div class="success-msg">✅ Complaint updated successfully.</div><?php endif; ?>

<div class="stats">
  <div class="stat"><h3 style="color:#854d0e"><?= $statMap['pending'] ?></h3><p>Pending</p></div>
  <div class="stat"><h3 style="color:#1e40af"><?= $statMap['in_review'] ?></h3><p>In Review</p></div>
  <div class="stat"><h3 style="color:#166534"><?= $statMap['resolved'] ?></h3><p>Resolved</p></div>
  <div class="stat"><h3 style="color:#dc2626"><?= $statMap['rejected'] ?></h3><p>Rejected</p></div>
</div>

<div class="filters">
  <a href="admin_complaints.php" class="<?= $filter==='all'?'active':'' ?>">All</a>
  <a href="?filter=pending" class="<?= $filter==='pending'?'active':'' ?>">Pending</a>
  <a href="?filter=in_review" class="<?= $filter==='in_review'?'active':'' ?>">In Review</a>
  <a href="?filter=resolved" class="<?= $filter==='resolved'?'active':'' ?>">Resolved</a>
  <a href="?filter=rejected" class="<?= $filter==='rejected'?'active':'' ?>">Rejected</a>
</div>

<div class="card">
<table>
  <tr><th>Date</th><th>Student</th><th>Category</th><th>Subject</th><th>Status</th><th>Update</th></tr>
  <?php if (empty($complaints)): ?>
  <tr><td colspan="6" style="text-align:center;padding:30px;color:#999">No complaints found.</td></tr>
  <?php else: ?>
  <?php foreach ($complaints as $c): ?>
  <tr>
    <td><?= date('d M Y', strtotime($c['created_at'])) ?></td>
    <td><?= htmlspecialchars($c['student_name']) ?><br><small style="color:#94a3b8"><?= htmlspecialchars($c['roll_no']) ?></small></td>
    <td><?= htmlspecialchars($c['category']) ?></td>
    <td>
      <strong><?= htmlspecialchars($c['subject']) ?></strong><br>
      <small style="color:#64748b"><?= substr(htmlspecialchars($c['description']), 0, 80) ?>...</small>
    </td>
    <td><span class="badge <?= $c['status'] ?>"><?= str_replace('_',' ',ucfirst($c['status'])) ?></span></td>
    <td>
      <form method="post">
        <input type="hidden" name="complaint_id" value="<?= $c['id'] ?>">
        <select name="status">
          <option value="pending" <?= $c['status']==='pending'?'selected':'' ?>>Pending</option>
          <option value="in_review" <?= $c['status']==='in_review'?'selected':'' ?>>In Review</option>
          <option value="resolved" <?= $c['status']==='resolved'?'selected':'' ?>>Resolved</option>
          <option value="rejected" <?= $c['status']==='rejected'?'selected':'' ?>>Rejected</option>
        </select><br><br>
        <input type="text" name="remarks" value="<?= htmlspecialchars($c['admin_remarks'] ?? '') ?>" placeholder="Remarks..."><br><br>
        <button type="submit" name="update_complaint" class="update">Update</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php endif; ?>
</table>
</div>
</body>
</html>
