<?php
require_once 'db.php'; session_start();
if(!isset($_SESSION['user'])){header('Location: login.php');exit;}
$user=$_SESSION['user'];
$message=$error='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $org_id=$_POST['org_id']; $type=$_POST['complaint_type'];
    $subject=trim($_POST['subject']); $desc=trim($_POST['description']);
    $priority=$_POST['priority'];
    if(empty($subject)||empty($desc)){$error='Subject and description are required.';}
    else{
        $tracking='TKT'.date('Ymd').rand(1000,9999);
        $pdo->prepare("INSERT INTO complaints (user_id,org_id,complaint_type,subject,description,priority,tracking_id) VALUES (?,?,?,?,?,?,?)")
            ->execute([$user['id'],$org_id,$type,$subject,$desc,$priority,$tracking]);
        $message="Complaint submitted! Tracking ID: <strong>$tracking</strong>";
    }
}

$orgs=$pdo->query("SELECT * FROM organizations")->fetchAll(PDO::FETCH_ASSOC);
$my=$pdo->prepare("SELECT c.*,o.name as org_name FROM complaints c JOIN organizations o ON c.org_id=o.id WHERE c.user_id=? ORDER BY c.created_at DESC");
$my->execute([$user['id']]);
$myComplaints=$my->fetchAll(PDO::FETCH_ASSOC);
$typesByOrg=['PMC'=>['Road Damage','Water Supply','Drainage','Garbage','Street Light','Illegal Construction'],
 'PMT'=>['Bus Delay','Driver Behavior','Route Issue','Overcrowding','Ticketing'],
 'MSEB'=>['Power Outage','High Bill','New Connection','Street Light','Meter Issue'],
 'PP'=>['Traffic','Public Nuisance','Safety','Cybercrime'],
 'UNIPUNE'=>['Exam Issue','Result Delay','Certificate','Fee Refund','Administration']];
?>
<!DOCTYPE html><html>
<head><title>File Complaint</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',sans-serif;background:#f8fafc;padding:30px}
nav{background:#1e3a5f;color:white;padding:15px 25px;border-radius:12px;display:flex;justify-content:space-between;align-items:center;margin-bottom:25px}
nav h2{margin:0;font-size:20px}
nav a{color:#93c5fd;text-decoration:none;font-size:14px}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:25px}
@media(max-width:768px){.grid{grid-template-columns:1fr}}
.card{background:white;padding:30px;border-radius:14px;box-shadow:0 2px 15px rgba(0,0,0,0.06)}
h3{color:#1e3a5f;margin-bottom:20px;font-size:18px}
label{display:block;font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px}
select,input[type=text],textarea{width:100%;padding:11px;border:2px solid #e2e8f0;border-radius:8px;font-size:15px;margin-bottom:15px;font-family:inherit}
select:focus,input:focus,textarea:focus{border-color:#1e3a5f;outline:none}
textarea{height:110px;resize:vertical}
button{background:#1e3a5f;color:white;border:none;padding:13px 25px;border-radius:8px;font-size:15px;cursor:pointer;width:100%;font-weight:600}
.msg{padding:14px;border-radius:10px;margin-bottom:18px;font-size:14px}
.success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.error{background:#fee2e2;color:#dc2626}
table{width:100%;border-collapse:collapse;font-size:13px}
th{background:#f8fafc;padding:10px;text-align:left;color:#475569;border-bottom:2px solid #e2e8f0;font-size:12px;text-transform:uppercase}
td{padding:10px;border-bottom:1px solid #f1f5f9;vertical-align:top}
.badge{padding:3px 9px;border-radius:10px;font-size:11px;font-weight:700;display:inline-block}
.open{background:#dbeafe;color:#1e40af}
.in_progress{background:#fef9c3;color:#854d0e}
.resolved{background:#dcfce7;color:#166534}
.closed{background:#f1f5f9;color:#475569}
.rejected{background:#fee2e2;color:#dc2626}
.priority-critical{color:#dc2626;font-weight:700}
.priority-high{color:#d97706}
.priority-medium{color:#2563eb}
.priority-low{color:#16a34a}
.full{grid-column:1/-1}
</style></head><body>
<nav>
  <h2>📋 <?=htmlspecialchars($user['name'])?> | Complaint Portal</h2>
  <a href="logout.php">Logout</a>
</nav>
<div class="grid">
  <div class="card">
    <h3>📝 File New Complaint</h3>
    <?php if($message):?><div class="msg success">✅ <?=$message?></div><?php endif;?>
    <?php if($error):?><div class="msg error">❌ <?=htmlspecialchars($error)?></div><?php endif;?>
    <form method="post">
      <label>Organization</label>
      <select name="org_id" id="orgSel" onchange="updateTypes(this)" required>
        <?php foreach($orgs as $o):?><option value="<?=$o['id']?>" data-code="<?=$o['code']?>"><?=$o['name']?> (<?=$o['code']?>)</option><?php endforeach;?>
      </select>
      <label>Complaint Type</label>
      <select name="complaint_type" id="typesSel" required>
        <?php foreach($typesByOrg['PMC'] as $t):?><option><?=$t?></option><?php endforeach;?>
      </select>
      <label>Priority</label>
      <select name="priority">
        <option value="low">Low</option>
        <option value="medium" selected>Medium</option>
        <option value="high">High</option>
        <option value="critical">Critical</option>
      </select>
      <label>Subject</label>
      <input type="text" name="subject" placeholder="Brief subject of your complaint" required>
      <label>Description</label>
      <textarea name="description" placeholder="Describe your complaint in detail..." required></textarea>
      <button type="submit">🚀 Submit Complaint</button>
    </form>
  </div>
  <div class="card">
    <h3>ℹ️ Organizations</h3>
    <?php foreach($orgs as $o):?>
    <div style="border:1px solid #e2e8f0;border-radius:10px;padding:14px;margin-bottom:12px">
      <div style="font-weight:700;color:#1e3a5f"><?=$o['name']?> <span style="background:#dbeafe;color:#1e40af;padding:2px 8px;border-radius:10px;font-size:11px"><?=$o['code']?></span></div>
      <div style="font-size:13px;color:#64748b;margin-top:4px"><?=htmlspecialchars($o['description'])?></div>
    </div>
    <?php endforeach;?>
  </div>
  <div class="card full">
    <h3>📋 My Complaints (<?=count($myComplaints)?>)</h3>
    <table>
      <tr><th>Tracking ID</th><th>Organization</th><th>Type</th><th>Subject</th><th>Priority</th><th>Status</th><th>Date</th></tr>
      <?php if(empty($myComplaints)):?>
      <tr><td colspan="7" style="text-align:center;padding:25px;color:#999">No complaints yet. File your first complaint above.</td></tr>
      <?php else: foreach($myComplaints as $c):?>
      <tr>
        <td><code style="background:#f1f5f9;padding:2px 6px;border-radius:4px;font-size:12px"><?=$c['tracking_id']?></code></td>
        <td><?=htmlspecialchars($c['org_name'])?></td>
        <td><?=htmlspecialchars($c['complaint_type'])?></td>
        <td><?=htmlspecialchars($c['subject'])?></td>
        <td class="priority-<?=$c['priority']?>"><?=ucfirst($c['priority'])?></td>
        <td><span class="badge <?=str_replace('_','',$c['status'])?>"><?=str_replace('_',' ',ucfirst($c['status']))?></span></td>
        <td><?=date('d M Y',strtotime($c['created_at']))?></td>
      </tr>
      <?php endforeach; endif;?>
    </table>
  </div>
</div>
<script>
const types=<?=json_encode($typesByOrg)?>;
const orgCodes=<?=json_encode(array_column($orgs,'code','id'))?>;
function updateTypes(sel){
  const code=sel.options[sel.selectedIndex].dataset.code;
  const opts=types[code]||[];
  const ts=document.getElementById('typesSel');
  ts.innerHTML=opts.map(t=>`<option>${t}</option>`).join('');
}
</script>
</body></html>
