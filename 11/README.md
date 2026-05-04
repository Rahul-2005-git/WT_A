# Assignment 11 - PHP Session Limiter (Max 3 Sessions, 5-Min Timeout)

## 📌 Features
- Limits each user to maximum **3 concurrent sessions**
- Sessions expire after **5 minutes** of inactivity
- Tracks sessions in **MySQL database**
- Dashboard to view active sessions and remaining time

---

## ⚙️ Requirements
- XAMPP (Apache + MySQL)
- PHP 7.4+
- MySQL 5.7+
- Web Browser (Chrome/Edge)

---

## 🚀 Setup & Run (Using XAMPP)

### 1️⃣ Start XAMPP
- Open XAMPP Control Panel
- Start:
  - Apache
  - MySQL

---

### 2️⃣ Copy Project Files
- Go to:

C:\xampp\htdocs\

- Create folder:

session-limiter

- Paste all project files inside this folder

---

### 3️⃣ Create Database
- Open browser:

http://localhost/phpmyadmin

- Click **Import**
- Select `schema.sql`
- Click **Go**

---

### 4️⃣ Configure Database Connection
- Open file: `db.php`
- Update credentials if needed:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "session_limiter";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

http://localhost/session-limiter/login.php
🔐 Demo Credentials
Username: student1
Password: password
Username: student2
Password: password
🧪 Testing Session Limit
Login using 3 different tabs or browsers
Try logging in from a 4th tab
System should block login (max 3 sessions)
⏱ Session Timeout
Session expires after 5 minutes of inactivity
After expiration, user must login again
📂 Project Structure
session-limiter/
│── db.php
│── login.php
│── dashboard.php
│── logout.php
│── schema.sql