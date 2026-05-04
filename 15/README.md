Here’s your README.md (XAMPP version for Assignment 15) 👇

# Assignment 15 - College Complaint Management System (PHP + MySQL)

## 📌 Features
- **Student Login** – secure login using email & password
- **Complaint Page** – submit complaints with category, subject, description
- **My Complaints** – students can view complaint status
- **Admin Login** – separate login for admin
- **Admin Dashboard** – manage complaints, update status, add remarks

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

complaint-system

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
$database = "complaint_system";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

Student Login:

http://localhost/complaint-system/student_login.php

Admin Login:

http://localhost/complaint-system/admin_login.php
🔐 Demo Credentials
Role	Login	Password
Student	rahul@college.com
	teacher123
Admin	admin	teacher123
🧪 How to Use
👨‍🎓 Student
Login using student credentials
Go to complaint page
Submit complaint (category, subject, description)
View status in My Complaints

🧑‍💼 Admin
Login using admin credentials
View all complaints
Filter complaints (Pending / In Progress / Resolved)
Update complaint status
Add remarks/comments
📂 Project Structure
complaint-system/
│── db.php
│── student_login.php
│── student_dashboard.php
│── add_complaint.php
│── my_complaints.php
│── admin_login.php
│── admin_dashboard.php
│── update_status.php
│── logout.php
│── schema.sql