# Assignment 21 - PHP Student Edit/Delete System

## 📌 Features
- Add new students (name, email, etc.)
- Edit existing student records
- Delete student records
- All operations handled on a single page
- Uses MySQL database (auto-created table)
- Simple CRUD (Create, Read, Update, Delete) system

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

21-php-student-edit-delete

- Paste all project files into this folder

---

### 3️⃣ Create Database
- Open browser:

http://localhost/phpmyadmin

- Create a new database:

student_db


> 💡 Table will be **auto-created** by `db.php`

---

### 4️⃣ Configure Database Connection
- Open file: `db.php`
- Update credentials if needed:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "student_db";
5️⃣ Run Project

Open browser:

http://localhost/21-php-student-edit-delete/
📂 Project Files
File	Purpose
db.php	Database connection + auto table creation
index.php	Main page to add, edit, delete students
🧪 How to Use
➕ Add Student
Fill form with student details
Click Add
Data saved in database
✏️ Edit Student
Click Edit button next to record
Modify details
Save changes
❌ Delete Student
Click Delete button
Record removed from database