<?php
require_once 'db.php';
$booking = null; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref = trim($_POST['ref']);
    $stmt = $pdo->prepare("SELECT b.*, f.flight_no, f.origin, f.destination, f.departure FROM bookings b JOIN flights f ON b.flight_id=f.id WHERE b.booking_ref=?");
    $stmt->execute([$ref]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$booking) $error = 'Booking reference not found.';
}
?>
<!DOCTYPE html><html>
<head><title>Check Booking</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#0a0a1a;color:white;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:100vh;padding:20px}
.card{background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:40px;width:100%;max-width:480px}
h2{color:#60a5fa;margin-bottom:20px;text-align:center}
input{width:100%;padding:12px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:8px;color:white;font-size:16px;margin-bottom:15px;box-sizing:border-box;text-transform:uppercase}
input::placeholder{color:rgba(255,255,255,0.3);text-transform:none}
input:focus{border-color:#60a5fa;outline:none}
button{width:100%;padding:13px;background:linear-gradient(135deg,#2563eb,#7c3aed);border:none;border-radius:8px;color:white;font-size:16px;font-weight:700;cursor:pointer}
.result{margin-top:20px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);border-radius:12px;padding:20px}
.row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.07);font-size:15px}
.row:last-child{border:none}
.label{color:rgba(255,255,255,0.5);font-size:13px}
.error{background:rgba(248,113,113,0.15);border:1px solid rgba(248,113,113,0.3);border-radius:8px;padding:12px;color:#f87171;text-align:center;margin-top:15px}
a{color:#60a5fa;text-decoration:none;display:block;text-align:center;margin-top:15px}
</style>
</head>
<body>
<div class="card">
  <h2>🔍 Check Booking</h2>
  <form method="post">
    <input type="text" name="ref" placeholder="Enter booking reference (e.g. SKYABCD1234)" required>
    <button type="submit">Check Status</button>
  </form>
  <?php if ($error): ?><div class="error"><?=htmlspecialchars($error)?></div><?php endif; ?>
  <?php if ($booking): ?>
  <div class="result">
    <div class="row"><span class="label">Booking Ref</span><strong><?=htmlspecialchars($booking['booking_ref'])?></strong></div>
    <div class="row"><span class="label">Flight</span><span><?=htmlspecialchars($booking['flight_no'])?></span></div>
    <div class="row"><span class="label">Route</span><span><?=$booking['origin']?> → <?=$booking['destination']?></span></div>
    <div class="row"><span class="label">Departure</span><span><?=date('d M Y H:i',strtotime($booking['departure']))?></span></div>
    <div class="row"><span class="label">Passenger</span><span><?=htmlspecialchars($booking['passenger_name'])?></span></div>
    <div class="row"><span class="label">Seat</span><strong style="color:#f59e0b"><?=htmlspecialchars($booking['seat_number'])?> (<?=ucfirst($booking['seat_class'])?>)</strong></div>
    <div class="row"><span class="label">Amount Paid</span><strong style="color:#4ade80">₹<?=number_format($booking['amount'],2)?></strong></div>
  </div>
  <?php endif; ?>
  <a href="index.php">← Back to Flights</a>
</div>
</body></html>
