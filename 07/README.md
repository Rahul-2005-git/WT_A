# 🎓 VIT Semester Result System

A responsive web application to calculate and store semester results of VIT students using React (Vite), PHP, and MySQL.

---

## 🚀 Tech Stack

* Frontend: React (Vite)
* Backend: PHP
* Database: MySQL
* Server: XAMPP (Apache + MySQL)

---

## 📁 Project Structure

result-app (React - Vite)
│
├── src/
│   ├── App.jsx
│   ├── Student.jsx
│   ├── Result.jsx
│   ├── App.css
│
xampp/htdocs/07/result-api/
│
├── save.php

---

## ⚙️ Features

* Enter marks for 4 subjects
* MSE (30%) + ESE (70%) calculation
* Dynamic result calculation (PASS/FAIL)
* State management using useState()
* Props used for component communication
* Save result to MySQL database
* Responsive UI

---

## 🧩 Components

### 1. App (Parent Component)

* Manages state using useState
* Passes data using props
* Handles API call to PHP

### 2. Student (Child Component)

* Displays student details
* Accepts marks input

### 3. Result (Child Component)

* Calculates weighted marks
* Displays total, average, and status

---

## 🧠 Result Logic

Final Marks = (MSE × 0.3) + (ESE × 0.7)

Average = Total / 4

Status:

* PASS → Average ≥ 40
* FAIL → Average < 40

---

## 🛢️ Database Setup

Open phpMyAdmin:

http://localhost/phpmyadmin

Run:

```sql
CREATE DATABASE result_db;

USE result_db;

CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  course VARCHAR(50),
  total FLOAT,
  status VARCHAR(10)
);
```

---

## 🐘 PHP Backend (save.php)

Location:

C:\xampp\htdocs\07\result-api\save.php

---

## ▶️ How to Run the Project

---

### 🔹 1. Start Backend

Open XAMPP

Start:

* Apache
* MySQL

---

### 🔹 2. Run React App

```bash
cd result-app
npm install
npm run dev
```

Open:

http://localhost:5173

---

### 🔹 3. API Endpoint

```text
http://localhost/07/result-api/save.php
```

---

### 🔹 4. Test Application

1. Enter marks
2. View dynamic result
3. Click "Save Result"
4. Check database

---

## 🗄️ Verify Data

Open:

http://localhost/phpmyadmin

Run:

```sql
SELECT * FROM results;
```

---

## ⚠️ Common Issues

### 1. CORS Error

Fix by adding in PHP:

```php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
```

---

### 2. Data Not Saving

* Check DB name
* Check table name
* Verify API URL

---

### 3. MySQL Connection Error

* Ensure correct username/password
* Start MySQL in XAMPP

---

## 🎯 Learning Outcomes

* React component architecture
* Props and state management
* Dynamic UI updates
* REST API communication
* PHP backend integration
* MySQL database operations

---

## 🚀 Future Enhancements

* Display saved results list
* Add validation (marks 0–100)
* Add login system
* Improve UI design

---

## 📌 Conclusion

This project demonstrates full-stack development using React, PHP, and MySQL with dynamic result processing and database integration.

---
