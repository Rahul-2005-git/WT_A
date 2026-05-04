# Assignment 17 - Waste Collection System (PHP + MySQL)

## 📌 Features
- Citizens can report waste (plastic, paper, metal, e-waste, etc.)
- Automatic assignment of nearest PMC/authority team
- Collection scheduled for next business day
- Track request status (Pending / Assigned / Collected)
- Displays recent waste collection requests
- Step-by-step process explanation for users

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

waste-collection-system

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
$database = "waste_collection";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

http://localhost/waste-collection-system/
🧪 How to Use
👤 Citizen
Open the homepage
Fill waste report form:
Waste type (plastic, paper, etc.)
Location
Description
Submit request
View request status in dashboard
🧑‍🔧 Authority / PMC
Login to admin panel (if implemented)
View assigned requests
Update status:
Pending → Assigned → Collected
Manage collection schedule
🔄 System Workflow
Citizen submits waste request
System finds nearest authority team
Assigns request automatically
Schedules collection (next working day)
Status updated and displayed
📂 Project Structure
waste-collection-system/
│── db.php
│── index.php
│── report_waste.php
│── dashboard.php
│── admin_panel.php
│── update_status.php
│── schema.sql