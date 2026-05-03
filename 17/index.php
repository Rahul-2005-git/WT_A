<?php
require_once 'db.php';
$message = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $type = $_POST['waste_type'];
    $quantity = $_POST['quantity'];
    $location = trim($_POST['location']);
    $landmark = trim($_POST['landmark'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($name) || empty($contact) || empty($location)) {
        $error = 'Name, contact, and location are required.';
    } else {
        // Auto-assign an available authority
        $auth = $pdo->query("SELECT id FROM authorities WHERE available=1 LIMIT 1")->fetch();
        $auth_id = $auth ? $auth['id'] : null;
        $scheduled = date('Y-m-d', strtotime('+1 day'));

        $pdo->prepare("INSERT INTO waste_requests (requester_name, contact, waste_type, quantity, location, landmark, description, authority_id, scheduled_date) VALUES (?,?,?,?,?,?,?,?,?)")
            ->execute([$name, $contact, $type, $quantity, $location, $landmark, $description, $auth_id, $scheduled]);

        $req_id = $pdo->lastInsertId();
        $message = "Request #$req_id submitted! Our team will collect your waste at the given location on $scheduled.";
        if ($auth_id) {
            $auth_info = $pdo->prepare("SELECT name, contact FROM authorities WHERE id=?");
            $auth_info->execute([$auth_id]);
            $a = $auth_info->fetch(PDO::FETCH_ASSOC);
            $message .= " Authority assigned: {$a['name']} ({$a['contact']})";
        }
    }
}

$recent = $pdo->query("SELECT w.*, a.name as authority_name FROM waste_requests w LEFT JOIN authorities a ON w.authority_id=a.id ORDER BY w.created_at DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Waste Collection System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Segoe UI', sans-serif; background: #f0fdf4; }
header { background: linear-gradient(135deg, #15803d, #166534); color: white; padding: 25px 40px; }
header h1 { font-size: 26px; }
header p { opacity: 0.8; font-size: 15px; margin-top: 5px; }
.container { max-width: 1100px; margin: 30px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
@media(max-width: 768px) { .container { grid-template-columns: 1fr; } }
.card { background: white; padding: 30px; border-radius: 14px; box-shadow: 0 2px 15px rgba(0,0,0,0.07); }
h2 { font-size: 20px; color: #14532d; margin-bottom: 20px; }
label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 5px; }
input, select, textarea { width: 100%; padding: 11px; border: 2px solid #d1fae5; border-radius: 8px; font-size: 15px; margin-bottom: 16px; font-family: inherit; }
input:focus, select:focus, textarea:focus { border-color: #15803d; outline: none; }
textarea { height: 90px; resize: vertical; }
button { background: linear-gradient(135deg, #15803d, #166534); color: white; border: none; padding: 13px 25px; border-radius: 8px; font-size: 16px; cursor: pointer; width: 100%; font-weight: 600; }
.msg { padding: 14px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; line-height: 1.5; }
.success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
.error { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
.waste-icons { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
.w-icon { text-align: center; padding: 12px; border: 2px solid #d1fae5; border-radius: 10px; font-size: 11px; color: #374151; cursor: default; }
.w-icon span { font-size: 24px; display: block; margin-bottom: 4px; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
th { background: #f0fdf4; padding: 10px; text-align: left; color: #166534; border-bottom: 2px solid #d1fae5; }
td { padding: 10px; border-bottom: 1px solid #f0f9f0; }
.badge { padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
.pending { background: #fef9c3; color: #854d0e; }
.assigned { background: #dbeafe; color: #1e40af; }
.collected { background: #dcfce7; color: #166534; }
.full-card { grid-column: 1 / -1; }
</style>
</head>
<body>
<header>
  <h1>♻️ Waste Collection System</h1>
  <p>Report waste at your location. Our PMC team will collect it within 24 hours.</p>
</header>

<div class="container">
  <div class="card">
    <h2>📍 Report Waste for Collection</h2>
    <?php if ($message): ?><div class="msg success">✅ <?= htmlspecialchars($message) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="msg error">❌ <?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div class="waste-icons">
      <div class="w-icon"><span>🧴</span>Plastic</div>
      <div class="w-icon"><span>📰</span>Paper</div>
      <div class="w-icon"><span>🔩</span>Metal</div>
      <div class="w-icon"><span>🔋</span>E-Waste</div>
    </div>

    <form method="post">
      <label>Your Name</label>
      <input type="text" name="name" placeholder="Full name" required>
      <label>Contact Number</label>
      <input type="tel" name="contact" placeholder="10-digit mobile number" required>
      <label>Waste Type</label>
      <select name="waste_type" required>
        <option value="plastic">🧴 Plastic</option>
        <option value="paper">📰 Paper</option>
        <option value="metal">🔩 Metal</option>
        <option value="glass">🍶 Glass</option>
        <option value="e-waste">🔋 E-Waste</option>
        <option value="mixed">♻️ Mixed Waste</option>
        <option value="other">📦 Other</option>
      </select>
      <label>Quantity</label>
      <select name="quantity">
        <option value="small">Small (1-2 bags)</option>
        <option value="medium" selected>Medium (3-5 bags)</option>
        <option value="large">Large (truck load)</option>
      </select>
      <label>Location / Address</label>
      <textarea name="location" placeholder="Full address where waste is located" required></textarea>
      <label>Nearby Landmark</label>
      <input type="text" name="landmark" placeholder="e.g., Near XYZ School">
      <label>Additional Description</label>
      <textarea name="description" placeholder="Any special instructions..." style="height:70px"></textarea>
      <button type="submit">🚛 Request Collection</button>
    </form>
  </div>

  <div class="card">
    <h2>📊 How It Works</h2>
    <div style="padding:10px 0">
      <?php
      $steps = [
        ['📍','Submit Location','Fill the form with waste type and your exact location'],
        ['🤖','Auto Assignment','System automatically assigns nearest available PMC team'],
        ['📅','Schedule','Collection is scheduled for the next business day'],
        ['🚛','Collection','PMC team arrives and collects waste at scheduled time'],
        ['♻️','Processing','Waste is sorted, recycled or disposed of responsibly']
      ];
      foreach ($steps as $i => [$icon, $title, $desc]):
      ?>
      <div style="display:flex;gap:15px;margin-bottom:20px;align-items:flex-start">
        <div style="width:44px;height:44px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0"><?= $icon ?></div>
        <div>
          <div style="font-weight:700;color:#14532d;margin-bottom:3px"><?= $title ?></div>
          <div style="font-size:13px;color:#6b7280"><?= $desc ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card full-card">
    <h2>📋 Recent Waste Collection Requests</h2>
    <table>
      <tr><th>#</th><th>Name</th><th>Waste Type</th><th>Location</th><th>Scheduled</th><th>Authority</th><th>Status</th></tr>
      <?php if (empty($recent)): ?>
      <tr><td colspan="7" style="text-align:center;padding:20px;color:#999">No requests yet. Be the first to report!</td></tr>
      <?php else: ?>
      <?php foreach ($recent as $r): ?>
      <tr>
        <td>#<?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['requester_name']) ?></td>
        <td><?= ucfirst($r['waste_type']) ?></td>
        <td><?= substr(htmlspecialchars($r['location']), 0, 50) ?>...</td>
        <td><?= $r['scheduled_date'] ?></td>
        <td><?= htmlspecialchars($r['authority_name'] ?? 'Pending') ?></td>
        <td><span class="badge <?= $r['status'] ?>"><?= ucfirst($r['status']) ?></span></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </table>
  </div>
</div>
</body>
</html>
