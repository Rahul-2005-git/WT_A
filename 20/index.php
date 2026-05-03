<?php
session_start();

// Initialize game state
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['current'] = 'X';
    $_SESSION['winner'] = null;
    $_SESSION['scores'] = ['X' => 0, 'O' => 0, 'draw' => 0];
    $_SESSION['mode'] = 'pvp'; // pvp or cpu
    $_SESSION['game_over'] = false;
}

function checkWinner($board) {
    $wins = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
    foreach ($wins as $w) {
        if ($board[$w[0]] && $board[$w[0]] === $board[$w[1]] && $board[$w[0]] === $board[$w[2]])
            return ['winner' => $board[$w[0]], 'line' => $w];
    }
    if (!in_array('', $board)) return ['winner' => 'draw', 'line' => []];
    return null;
}

function cpuMove($board) {
    // Win if possible
    $wins = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
    foreach ($wins as $w) {
        $vals = [$board[$w[0]], $board[$w[1]], $board[$w[2]]];
        if (array_count_values($vals)['O'] ?? 0 === 2 && in_array('', $vals)) return $w[array_search('', $vals)];
    }
    // Block X
    foreach ($wins as $w) {
        $vals = [$board[$w[0]], $board[$w[1]], $board[$w[2]]];
        if ((array_count_values($vals)['X'] ?? 0) === 2 && in_array('', $vals)) return $w[array_search('', $vals)];
    }
    // Center
    if ($board[4] === '') return 4;
    // Corners
    foreach ([0,2,6,8] as $c) if ($board[$c] === '') return $c;
    // Any
    foreach (range(0,8) as $i) if ($board[$i] === '') return $i;
    return -1;
}

// Handle AJAX move
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'reset') {
        $_SESSION['board'] = array_fill(0, 9, '');
        $_SESSION['current'] = 'X';
        $_SESSION['winner'] = null;
        $_SESSION['game_over'] = false;
        echo json_encode(['ok' => true]);
        exit;
    }
    
    if ($_POST['action'] === 'mode') {
        $_SESSION['mode'] = $_POST['mode'];
        $_SESSION['board'] = array_fill(0, 9, '');
        $_SESSION['current'] = 'X';
        $_SESSION['winner'] = null;
        $_SESSION['game_over'] = false;
        echo json_encode(['ok' => true]);
        exit;
    }
    
    if ($_POST['action'] === 'reset_scores') {
        $_SESSION['scores'] = ['X' => 0, 'O' => 0, 'draw' => 0];
        echo json_encode(['ok' => true]);
        exit;
    }

    if ($_POST['action'] === 'move' && !$_SESSION['game_over']) {
        $pos = (int)$_POST['pos'];
        if ($pos >= 0 && $pos <= 8 && $_SESSION['board'][$pos] === '') {
            $_SESSION['board'][$pos] = $_SESSION['current'];
            $result = checkWinner($_SESSION['board']);
            
            if ($result) {
                $_SESSION['game_over'] = true;
                $_SESSION['winner'] = $result['winner'];
                if ($result['winner'] === 'draw') $_SESSION['scores']['draw']++;
                else $_SESSION['scores'][$result['winner']]++;
                echo json_encode(['board' => $_SESSION['board'], 'winner' => $result['winner'], 'line' => $result['line'], 'scores' => $_SESSION['scores']]);
                exit;
            }
            
            $_SESSION['current'] = ($_SESSION['current'] === 'X') ? 'O' : 'X';
            
            // CPU move
            if ($_SESSION['mode'] === 'cpu' && $_SESSION['current'] === 'O' && !$_SESSION['game_over']) {
                $cpuPos = cpuMove($_SESSION['board']);
                if ($cpuPos >= 0) {
                    $_SESSION['board'][$cpuPos] = 'O';
                    $result = checkWinner($_SESSION['board']);
                    if ($result) {
                        $_SESSION['game_over'] = true;
                        $_SESSION['winner'] = $result['winner'];
                        if ($result['winner'] === 'draw') $_SESSION['scores']['draw']++;
                        else $_SESSION['scores'][$result['winner']]++;
                        echo json_encode(['board' => $_SESSION['board'], 'winner' => $result['winner'], 'line' => $result['line'], 'scores' => $_SESSION['scores'], 'cpu' => $cpuPos]);
                        exit;
                    }
                    $_SESSION['current'] = 'X';
                }
            }
        }
        echo json_encode(['board' => $_SESSION['board'], 'current' => $_SESSION['current'], 'scores' => $_SESSION['scores']]);
        exit;
    }
    echo json_encode(['ok' => false]);
    exit;
}
?>
<!DOCTYPE html><html>
<head>
<title>Tic-Tac-Toe</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:#0f0f1a;color:white;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:20px}
h1{font-size:36px;font-weight:800;background:linear-gradient(135deg,#818cf8,#f472b6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:5px;text-align:center}
.tagline{color:rgba(255,255,255,0.4);font-size:14px;margin-bottom:25px;text-align:center}
.mode-btns{display:flex;gap:10px;margin-bottom:20px}
.mode-btn{padding:9px 20px;border-radius:20px;border:2px solid rgba(255,255,255,0.15);background:transparent;color:rgba(255,255,255,0.6);cursor:pointer;font-size:14px;font-weight:600;transition:all .2s}
.mode-btn.active{background:rgba(129,140,248,0.2);border-color:#818cf8;color:#818cf8}
.scoreboard{display:flex;gap:15px;margin-bottom:25px}
.score-box{text-align:center;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:12px 20px;min-width:80px}
.score-label{font-size:12px;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:.5px}
.score-val{font-size:28px;font-weight:800;margin-top:3px}
.x-color{color:#f472b6}
.o-color{color:#818cf8}
.d-color{color:rgba(255,255,255,0.5)}
.status{font-size:18px;font-weight:600;margin-bottom:20px;text-align:center;min-height:28px}
.board{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:20px;width:280px}
.cell{width:85px;height:85px;background:rgba(255,255,255,0.05);border:2px solid rgba(255,255,255,0.1);border-radius:14px;font-size:38px;font-weight:800;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;user-select:none}
.cell:hover:empty{background:rgba(255,255,255,0.1);transform:scale(1.05)}
.cell.x{color:#f472b6;border-color:rgba(244,114,182,0.4);background:rgba(244,114,182,0.08)}
.cell.o{color:#818cf8;border-color:rgba(129,140,248,0.4);background:rgba(129,140,248,0.08)}
.cell.win{animation:pulse .5s ease-in-out infinite alternate}
@keyframes pulse{from{box-shadow:0 0 0 0 rgba(250,204,21,0.4)}to{box-shadow:0 0 0 12px rgba(250,204,21,0)}}
.cell.win.x{color:#fbbf24;border-color:#fbbf24;background:rgba(251,191,36,0.15)}
.cell.win.o{color:#fbbf24;border-color:#fbbf24;background:rgba(251,191,36,0.15)}
.btns{display:flex;gap:10px}
.btn{padding:11px 22px;border-radius:10px;border:none;font-size:15px;font-weight:700;cursor:pointer;transition:opacity .2s}
.btn:hover{opacity:.85}
.btn-primary{background:linear-gradient(135deg,#818cf8,#f472b6);color:white}
.btn-secondary{background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.7);border:1px solid rgba(255,255,255,0.15)}
.winner-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:10;backdrop-filter:blur(4px)}
.winner-card{background:#1a1a2e;border:1px solid rgba(255,255,255,0.2);border-radius:24px;padding:40px;text-align:center;max-width:320px;animation:pop .3s ease-out}
@keyframes pop{from{transform:scale(.8);opacity:0}to{transform:scale(1);opacity:1}}
.winner-emoji{font-size:64px;margin-bottom:10px}
.winner-text{font-size:24px;font-weight:800;margin-bottom:20px}
.hidden{display:none}
</style>
</head>
<body>
<h1>Tic-Tac-Toe</h1>
<p class="tagline">Classic game, modern look</p>

<div class="mode-btns">
  <button class="mode-btn <?=($_SESSION['mode']==='pvp'?'active':'')?>" onclick="setMode('pvp')">👥 2 Players</button>
  <button class="mode-btn <?=($_SESSION['mode']==='cpu'?'active':'')?>" onclick="setMode('cpu')">🤖 vs CPU</button>
</div>

<div class="scoreboard">
  <div class="score-box"><div class="score-label">Player X</div><div class="score-val x-color" id="scoreX"><?=$_SESSION['scores']['X']?></div></div>
  <div class="score-box"><div class="score-label">Draws</div><div class="score-val d-color" id="scoreDraw"><?=$_SESSION['scores']['draw']?></div></div>
  <div class="score-box"><div class="score-label"><?=($_SESSION['mode']==='cpu'?'CPU':'Player')?> O</div><div class="score-val o-color" id="scoreO"><?=$_SESSION['scores']['O']?></div></div>
</div>

<div class="status" id="status">
  <?php if(!$_SESSION['game_over']): ?>
    <?php if($_SESSION['mode']==='cpu'&&$_SESSION['current']==='O'): ?>Thinking...<?php else: ?>Player <?=$_SESSION['current']?>'s turn<?php endif; ?>
  <?php elseif($_SESSION['winner']==='draw'): ?>It's a Draw!
  <?php else: ?><?=($_SESSION['mode']==='cpu'&&$_SESSION['winner']==='O'?'CPU':'Player '.$_SESSION['winner'])?> wins!
  <?php endif; ?>
</div>

<div class="board" id="board">
  <?php foreach ($_SESSION['board'] as $i => $cell): ?>
  <div class="cell <?=strtolower($cell)?>" id="cell<?=$i?>" onclick="makeMove(<?=$i?>)"><?=$cell?></div>
  <?php endforeach; ?>
</div>

<div class="btns">
  <button class="btn btn-primary" onclick="resetGame()">New Game</button>
  <button class="btn btn-secondary" onclick="resetScores()">Reset Scores</button>
</div>

<div class="winner-overlay hidden" id="overlay">
  <div class="winner-card">
    <div class="winner-emoji" id="overlayEmoji"></div>
    <div class="winner-text" id="overlayText"></div>
    <button class="btn btn-primary" onclick="closeOverlay()">Play Again</button>
  </div>
</div>

<script>
let currentWinLine = [];

function makeMove(pos) {
  fetch('', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:`action=move&pos=${pos}`})
  .then(r=>r.json()).then(data=>{
    if (data.board) updateBoard(data.board);
    if (data.scores) updateScores(data.scores);
    if (data.winner) {
      currentWinLine = data.line || [];
      highlightWin(data.line || [], data.board);
      showWinner(data.winner);
    } else if (data.current) {
      document.getElementById('status').textContent = `Player ${data.current}'s turn`;
    }
  });
}

function updateBoard(board) {
  board.forEach((v, i) => {
    const cell = document.getElementById('cell'+i);
    cell.textContent = v;
    cell.className = 'cell ' + (v ? v.toLowerCase() : '');
  });
}

function highlightWin(line, board) {
  line.forEach(i => {
    const cell = document.getElementById('cell'+i);
    cell.classList.add('win');
  });
  document.querySelectorAll('.cell').forEach(c => { if(!line.includes(parseInt(c.id.replace('cell','')))) c.style.opacity='.3'; });
}

function showWinner(winner) {
  const overlay = document.getElementById('overlay');
  overlay.classList.remove('hidden');
  if (winner === 'draw') {
    document.getElementById('overlayEmoji').textContent = '🤝';
    document.getElementById('overlayText').innerHTML = "It's a Draw!";
  } else {
    document.getElementById('overlayEmoji').textContent = winner==='X' ? '🎉' : '🤖';
    const name = (document.querySelector('.mode-btn.active').textContent.includes('CPU') && winner==='O') ? 'CPU' : `Player ${winner}`;
    document.getElementById('overlayText').innerHTML = `${name} Wins!`;
  }
  document.getElementById('status').textContent = document.getElementById('overlayText').textContent;
}

function closeOverlay() {
  document.getElementById('overlay').classList.add('hidden');
  resetGame();
}

function updateScores(s) {
  document.getElementById('scoreX').textContent = s.X;
  document.getElementById('scoreO').textContent = s.O;
  document.getElementById('scoreDraw').textContent = s.draw;
}

function resetGame() {
  fetch('', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'action=reset'})
  .then(r=>r.json()).then(()=>{
    for(let i=0;i<9;i++) { const c=document.getElementById('cell'+i); c.textContent=''; c.className='cell'; c.style.opacity=''; }
    document.getElementById('overlay').classList.add('hidden');
    document.getElementById('status').textContent = "Player X's turn";
  });
}

function resetScores() {
  fetch('', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'action=reset_scores'})
  .then(r=>r.json()).then(()=>updateScores({X:0,O:0,draw:0}));
}

function setMode(mode) {
  fetch('', {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:`action=mode&mode=${mode}`})
  .then(r=>r.json()).then(()=>{
    document.querySelectorAll('.mode-btn').forEach(b=>b.classList.remove('active'));
    event.target.classList.add('active');
    const oLabel = document.getElementById('scoreO').previousElementSibling;
    oLabel.textContent = (mode==='cpu') ? 'CPU O' : 'Player O';
    for(let i=0;i<9;i++){const c=document.getElementById('cell'+i);c.textContent='';c.className='cell';c.style.opacity='';}
    document.getElementById('status').textContent="Player X's turn";
  });
}
</script>
</body></html>
