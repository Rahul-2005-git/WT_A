# Assignment 12 - Attendance System (PHP + MySQL)

## 📌 Features
- **Student Registration** – Students can register using roll no, name, email, class
- **Teacher Attendance** – Teachers can mark attendance using checkboxes
- **Student Dashboard** – View attendance records and percentage
- **Date & Subject Selection** for each attendance session

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

attendance-system

- Paste all your project files into this folder

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
$database = "attendance_system";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser and access:

Student Register:

http://localhost/attendance-system/student_register.php

Student Login:

http://localhost/attendance-system/student_login.php

Teacher Login:

http://localhost/attendance-system/teacher_login.php
🔐 Demo Credentials
Role	Email	Password
Teacher	sharma@college.com
	teacher123
Student	rahul@student.com
	teacher123
🧪 How to Use
👨‍🎓 Student
Register using Student Register page
Login using Student Login
View attendance and percentage
👨‍🏫 Teacher
Login using Teacher Login
Select subject and date
Mark attendance using checkboxes
Submit attendance
📂 Project Structure
attendance-system/
│── db.php
│── student_register.php
│── student_login.php
│── teacher_login.php
│── dashboard.php
│── mark_attendance.php
│── schema.sql