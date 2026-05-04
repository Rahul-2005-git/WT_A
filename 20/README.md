# Assignment 20 - Tic-Tac-Toe Game (PHP)

## 📌 Features
- Classic **3×3 Tic-Tac-Toe** game
- Two game modes:
  - 👥 Player vs Player (same device)
  - 🤖 Player vs CPU (basic AI with win/block logic)
- Animated winner highlight (pulsing effect)
- Winner popup overlay
- Score tracker (X wins / O wins / Draws) using PHP sessions
- No database required (session-based state)
- Fully responsive design

---

## ⚙️ Requirements
- XAMPP (Apache)
- PHP 7.4+
- Web Browser (Chrome/Edge)

---

## 🚀 Setup & Run (Using XAMPP)

### 1️⃣ Start XAMPP
- Open XAMPP Control Panel
- Start:
  - Apache  
> ❗ MySQL is NOT required for this project

---

### 2️⃣ Copy Project Files
- Go to:

C:\xampp\htdocs\

- Create folder:

tic-tac-toe

- Paste all project files into this folder

---

### 3️⃣ Run Project
Open browser:
``` id="d4k7xm"
http://localhost/tic-tac-toe/
🎮 How to Play
Choose game mode:
Player vs Player
Player vs CPU
Click any empty cell to place your mark (X or O)
First player to get 3 in a row wins:
Horizontal
Vertical
Diagonal
Click "New Game" to restart
🧠 Game Logic
Game board stored in PHP session
Turn alternates between players
CPU logic:
Try to win if possible
Block opponent’s winning move
Otherwise choose best available position
📊 Score Tracking
Stored in session:
X Wins
O Wins
Draws
Persists until browser session ends or reset
📂 Project Structure
tic-tac-toe/
│── index.php
│── game.php
│── styles.css
│── script.js