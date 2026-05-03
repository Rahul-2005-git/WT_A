<?php
require_once 'db.php';
$flights=$pdo->query("SELECT * FROM flights ORDER BY departure")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html><html>
<head><title>SkyBook - Airline Seat Booking</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',sans-serif;background:#0a0a1a;color:white;min-height:100vh}
header{background:linear-gradient(135deg,#1a1a3e,#0d0d2b);padding:20px 40px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(255,255,255,0.1)}
.logo{font-size:24px;font-weight:700;color:#60a5fa}
.hero{background:linear-gradient(135deg,#0d0d2b,#1e1e4a);padding:60px 40px;text-align:center}
.hero h1{font-size:48px;font-weight:800;background:linear-gradient(135deg,#60a5fa,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:10px}
.hero p{color:rgba(255,255,255,0.6);font-size:18px}
.container{max-width:1100px;margin:40px auto;padding:0 20px}
h2{font-size:24px;margin-bottom:25px;color:#93c5fd}
.flights-grid{display:grid;gap:20px}
.flight-card{background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:25px;display:grid;grid-template-columns:1fr auto 1fr auto;align-items:center;gap:20px;transition:border-color .2s}
.flight-card:hover{border-color:#60a5fa}
.city{font-size:22px;font-weight:700}
.airport{font-size:13px;color:rgba(255,255,255,0.5);margin-top:3px}
.time{font-size:16px;font-weight:600;color:#93c5fd;margin-top:5px}
.arrow{text-align:center;color:rgba(255,255,255,0.4);font-size:24px}
.duration{font-size:12px;color:rgba(255,255,255,0.5);margin-top:3px}
.flight-no{background:rgba(96,165,250,0.15);color:#60a5fa;padding:4px 12px;border-radius:20px;font-size:13px;font-weight:700;margin-bottom:8px;display:inline-block}
.price-block{text-align:right}
.price{font-size:24px;font-weight:800;color:#60a5fa}
.price small{font-size:13px;font-weight:400;color:rgba(255,255,255,0.5)}
.btn{display:inline-block;padding:10px 22px;background:linear-gradient(135deg,#2563eb,#7c3aed);color:white;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;margin-top:10px}
.status{font-size:12px;padding:3px 10px;border-radius:10px;font-weight:600}
.scheduled{background:rgba(34,197,94,0.2);color:#4ade80}
.boarding{background:rgba(251,191,36,0.2);color:#fbbf24}
</style>
</head>
<body>
<header>
  <div class="logo">✈️ SkyBook</div>
  <a href="check_booking.php" style="color:#93c5fd;text-decoration:none;font-size:14px">🔍 Check Booking</a>
</header>
<div class="hero">
  <h1>Book Your Flight</h1>
  <p>Fast. Easy. Affordable. Choose from available flights below.</p>
</div>
<div class="container">
  <h2>✈️ Available Flights</h2>
  <div class="flights-grid">
    <?php foreach($flights as $f):
      $stmt=$pdo->prepare("SELECT seat_number FROM bookings WHERE flight_id=?");
      $stmt->execute([$f['id']]);
      $booked=count($stmt->fetchAll());
      $avail=$f['total_seats']-$booked;
    ?>
    <div class="flight-card">
      <div>
        <span class="flight-no"><?=htmlspecialchars($f['flight_no'])?></span>
        <span class="status <?=$f['status']?>"><?=ucfirst($f['status'])?></span>
        <div class="city"><?=explode(' ',$f['origin'])[0]?></div>
        <div class="airport"><?=$f['origin']?></div>
        <div class="time"><?=date('H:i',strtotime($f['departure']))?></div>
      </div>
      <div class="arrow">
        ✈️<br>
        <div class="duration"><?=round((strtotime($f['arrival'])-strtotime($f['departure']))/3600,1)?>h</div>
      </div>
      <div>
        <div class="city"><?=explode(' ',$f['destination'])[0]?></div>
        <div class="airport"><?=$f['destination']?></div>
        <div class="time"><?=date('H:i',strtotime($f['arrival']))?></div>
      </div>
      <div class="price-block">
        <div class="price">₹<?=number_format($f['price_economy'],0)?><small>/person</small></div>
        <div style="font-size:13px;color:rgba(255,255,255,0.5);margin-top:4px"><?=$avail?> seats left</div>
        <?php if($f['status']==='cancelled'):?>
        <span style="color:#f87171;font-size:14px">Flight Cancelled</span>
        <?php else:?>
        <a href="seats.php?flight=<?=$f['id']?>" class="btn">Select Seat</a>
        <?php endif;?>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
</body></html>
