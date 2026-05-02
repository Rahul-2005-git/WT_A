<?php
require_once 'db.php';
$flight_id = (int)($_GET['flight'] ?? 0);
if (!$flight_id) { header('Location: index.php'); exit; }

$flight = $pdo->prepare("SELECT * FROM flights WHERE id=?");
$flight->execute([$flight_id]);
$f = $flight->fetch(PDO::FETCH_ASSOC);
if (!$f) { header('Location: index.php'); exit; }

$booked_stmt = $pdo->prepare("SELECT seat_number, seat_class FROM bookings WHERE flight_id=?");
$booked_stmt->execute([$flight_id]);
$bookedSeats = [];
foreach ($booked_stmt->fetchAll(PDO::FETCH_ASSOC) as $b) {
    $bookedSeats[$b['seat_number']] = $b['seat_class'];
}

$message = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seat = $_POST['seat'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $class = (in_array(substr($seat, 0, 1), ['A', 'B']) ? 'business' : 'economy');
    $price = ($class === 'business') ? $f['price_business'] : $f['price_economy'];
    $ref = 'SKY' . strtoupper(substr(md5(uniqid()), 0, 8));

    if (isset($bookedSeats[$seat])) {
        $error = "Seat $seat is already booked. Please choose another.";
    } elseif (empty($name) || empty($email) || empty($mobile)) {
        $error = "All passenger details are required.";
    } else {
        try {
            $pdo->prepare("INSERT INTO bookings (flight_id, passenger_name, passenger_email, passenger_mobile, seat_number, seat_class, booking_ref, amount) VALUES (?,?,?,?,?,?,?,?)")
                ->execute([$flight_id, $name, $email, $mobile, $seat, $class, $ref, $price]);
            $bookedSeats[$seat] = $class;
            $message = "🎉 Booking confirmed! Seat: $seat | Class: " . ucfirst($class) . " | Ref: <strong>$ref</strong> | Amount: ₹" . number_format($price, 2);
        } catch (PDOException $e) {
            $error = "Seat already taken. Please choose another.";
        }
    }
}

// Build seat map: rows 1-2 = Business (A-F), rows 3-10 = Economy
$rows = range(1, 10);
$cols = ['A','B','C','D','E','F'];
?>
<!DOCTYPE html><html>
<head><title>Select Seat - <?=htmlspecialchars($f['flight_no'])?></title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',sans-serif;background:#0a0a1a;color:white;min-height:100vh;padding:30px 20px}
h1{font-size:22px;color:#60a5fa;margin-bottom:5px}
.sub{color:rgba(255,255,255,0.5);font-size:14px;margin-bottom:25px}
.layout{display:grid;grid-template-columns:1fr 420px;gap:30px;max-width:950px;margin:auto}
@media(max-width:768px){.layout{grid-template-columns:1fr}}
.plane{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:25px}
.legend{display:flex;gap:15px;margin-bottom:20px;font-size:13px;flex-wrap:wrap}
.leg{display:flex;align-items:center;gap:6px}
.dot{width:18px;height:18px;border-radius:4px}
.row-label{display:grid;grid-template-columns:30px repeat(3,36px) 20px repeat(3,36px);gap:6px;align-items:center;margin-bottom:6px}
.seat{width:36px;height:36px;border-radius:6px 6px 3px 3px;border:none;cursor:pointer;font-size:11px;font-weight:700;transition:transform .15s,opacity .15s}
.seat:hover:not(.booked){transform:scale(1.1)}
.economy{background:#1e40af;color:white}
.business{background:#7c3aed;color:white}
.selected{background:#f59e0b!important;color:#1a1a2e!important;transform:scale(1.15)!important}
.booked{background:#374151!important;color:#6b7280!important;cursor:not-allowed;opacity:.6}
.aisle{width:20px}
.row-num{width:30px;text-align:center;font-size:12px;color:rgba(255,255,255,0.5)}
.class-divider{text-align:center;padding:8px;background:rgba(124,58,237,0.2);border:1px solid rgba(124,58,237,0.4);border-radius:8px;font-size:12px;color:#a78bfa;margin:10px 0}
.form-card{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:25px}
label{display:block;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase;margin-bottom:5px}
input{width:100%;padding:11px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:8px;color:white;font-size:15px;margin-bottom:16px}
input::placeholder{color:rgba(255,255,255,0.3)}
input:focus{border-color:#60a5fa;outline:none}
.selected-info{background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);border-radius:10px;padding:14px;margin-bottom:20px;font-size:14px}
button[type=submit]{width:100%;padding:13px;background:linear-gradient(135deg,#2563eb,#7c3aed);color:white;border:none;border-radius:10px;font-size:16px;font-weight:700;cursor:pointer}
.msg{padding:14px;border-radius:10px;margin-bottom:18px;font-size:14px;line-height:1.6}
.success{background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3)}
.error-msg{background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3)}
a.back{color:#60a5fa;text-decoration:none;font-size:14px;display:inline-block;margin-bottom:20px}
</style>
</head>
<body>
<div style="max-width:950px;margin:auto">
<a href="index.php" class="back">← Back to Flights</a>
<h1>✈️ <?=htmlspecialchars($f['flight_no'])?> — <?=$f['origin']?> → <?=$f['destination']?></h1>
<div class="sub">Departure: <?=date('d M Y H:i',strtotime($f['departure']))?> | Select your preferred seat</div>

<?php if($message):?><div class="msg success"><?=$message?></div><?php endif;?>
<?php if($error):?><div class="msg error-msg">❌ <?=htmlspecialchars($error)?></div><?php endif;?>

<div class="layout">
  <div class="plane">
    <div class="legend">
      <div class="leg"><div class="dot" style="background:#7c3aed"></div> Business</div>
      <div class="leg"><div class="dot" style="background:#1e40af"></div> Economy</div>
      <div class="leg"><div class="dot" style="background:#f59e0b"></div> Selected</div>
      <div class="leg"><div class="dot" style="background:#374151"></div> Booked</div>
    </div>
    <div class="class-divider">✈️ BUSINESS CLASS — Rows 1–2 | ₹<?=number_format($f['price_business'],0)?></div>
    <?php foreach ($rows as $row):
      $isBusiness = ($row <= 2);
      if ($row === 3): ?>
      <div class="class-divider" style="margin-top:15px">💺 ECONOMY CLASS — Rows 3–10 | ₹<?=number_format($f['price_economy'],0)?></div>
      <?php endif; ?>
      <div class="row-label">
        <div class="row-num"><?=$row?></div>
        <?php foreach ($cols as $ci => $col):
          if ($ci === 3): echo '<div class="aisle"></div>'; endif;
          $seatId = $row . $col;
          $isBooked = isset($bookedSeats[$seatId]);
          $cls = $isBusiness ? 'business' : 'economy';
          $classes = "seat $cls" . ($isBooked ? ' booked' : '');
        ?>
        <button class="<?=$classes?>" onclick="selectSeat('<?=$seatId?>')" <?=$isBooked?'disabled':''?> title="<?=$seatId?>"><?=$seatId?></button>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="form-card">
    <h3 style="margin-bottom:20px;color:#93c5fd">👤 Passenger Details</h3>
    <div class="selected-info" id="seatInfo">No seat selected. Click a seat to select.</div>
    <form method="post">
      <input type="hidden" name="seat" id="seatInput" value="">
      <label>Full Name</label>
      <input type="text" name="name" placeholder="As per Aadhaar/Passport" required>
      <label>Email</label>
      <input type="email" name="email" placeholder="your@email.com" required>
      <label>Mobile</label>
      <input type="tel" name="mobile" placeholder="10-digit mobile" required>
      <button type="submit" id="bookBtn" disabled>🎫 Book Seat</button>
    </form>

    <div style="margin-top:25px;border-top:1px solid rgba(255,255,255,0.1);padding-top:20px">
      <h4 style="color:#93c5fd;margin-bottom:15px">📋 Booked Seats</h4>
      <?php
      $bookedList = $pdo->prepare("SELECT seat_number, seat_class, passenger_name FROM bookings WHERE flight_id=? ORDER BY seat_number");
      $bookedList->execute([$flight_id]);
      $bl = $bookedList->fetchAll(PDO::FETCH_ASSOC);
      if(empty($bl)): ?>
      <p style="color:rgba(255,255,255,0.4);font-size:13px">No seats booked yet.</p>
      <?php else: ?>
      <div style="display:flex;flex-wrap:wrap;gap:6px">
      <?php foreach($bl as $b): ?>
        <div style="background:rgba(55,65,81,0.8);border-radius:6px;padding:5px 10px;font-size:12px">
          <strong style="color:#f59e0b"><?=htmlspecialchars($b['seat_number'])?></strong>
          <span style="color:rgba(255,255,255,0.5)"> <?=ucfirst($b['seat_class'])?></span>
        </div>
      <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>
<script>
let selected = null;
const biz = <?=json_encode($f['price_business'])?>;
const eco = <?=json_encode($f['price_economy'])?>;
function selectSeat(id) {
  if (selected) {
    const prev = document.querySelector(`.seat[title="${selected}"]`);
    if (prev) { const isBiz = parseInt(selected) <= 2; prev.classList.remove('selected'); prev.classList.add(isBiz ? 'business' : 'economy'); }
  }
  selected = id;
  document.getElementById('seatInput').value = id;
  const row = parseInt(id); const isBiz = row <= 2;
  const el = document.querySelector(`.seat[title="${id}"]`);
  if (el) { el.classList.remove('business','economy'); el.classList.add('selected'); }
  const price = isBiz ? biz : eco;
  const cls = isBiz ? 'Business' : 'Economy';
  document.getElementById('seatInfo').innerHTML = `<strong>Selected:</strong> Seat ${id} — ${cls} Class<br><strong>Price:</strong> ₹${price.toLocaleString('en-IN')}`;
  document.getElementById('bookBtn').disabled = false;
}
</script>
</body></html>
