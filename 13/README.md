# Assignment 13 - PHP Login Module with Cookies & Sessions

## 📌 Features
- **User Registration** with password validation
- **Login Form** with username/email support
- **Remember Me** – stores encrypted token in cookie (30 days)
- **Session Management** – PHP sessions track logged-in users
- **MySQL Database** – users stored with hashed passwords
- **Auto-login** via remember-me cookie on return visits

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

login-module

- Paste all project files into this folder

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
$database = "login_module";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

http://localhost/login-module/
🔐 How to Use
👤 Registration
Open registration page
Enter username/email and password
Submit to create account
🔑 Login
Enter username/email and password
Tick Remember Me checkbox
Login successfully
🍪 Remember Me Feature
Stores secure token in browser cookie
Cookie valid for 30 days
Auto-login works after reopening browser
🧪 Testing
Register a new account
Login with Remember Me checked
Close browser completely
Reopen and revisit site
✅ You should be auto-logged in
📂 Project Structure
login-module/
│── db.php
│── register.php
│── login.php
│── dashboard.php
│── logout.php
│── schema.sql
⚠️ Notes
Ensure Apache & MySQL are running in XAMPP
Cookies must be enabled in browser
Use Incognito mode for multiple user testing