# Assignment 18 - Complaint Management System (PHP + MySQL)

## 📌 Features
- Citizen **Registration & Login**
- File complaints against multiple organizations:
  - PMC
  - PMT
  - MSEB
  - Pune Police
  - University of Pune
- Dynamic complaint types based on selected organization
- Priority levels: **Low, Medium, High, Critical**
- Unique tracking ID for each complaint
- View all complaints with status tracking

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

complaint-management

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
$database = "complaint_management";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

http://localhost/complaint-management/
🔐 How to Use
👤 Citizen
Register a new account
Login using credentials
Select organization (PMC, PMT, etc.)
Choose complaint type (dynamic)
Set priority level
Submit complaint
🧾 Complaint Tracking
Each complaint gets a unique tracking ID
Users can:
View submitted complaints
Track status (Pending / In Progress / Resolved)
🧪 Testing
Register a new account
Login
File complaints for different organizations
Check tracking ID and status updates
📂 Project Structure
complaint-management/
│── db.php
│── register.php
│── login.php
│── dashboard.php
│── file_complaint.php
│── view_complaints.php
│── logout.php
│── schema.sql