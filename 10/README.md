# 🎓 Student Registration System (Node.js + MySQL)

A simple web-based application that allows students to register their details and stores the data in a MySQL database. The system also provides an API and browser view to display all registered students.

---

## 🚀 Tech Stack

* Backend: Node.js, Express.js
* Database: MySQL
* Frontend: HTML (Form)
* Tools: Postman (API testing)

---

## 📁 Project Structure

student-app/
│
├── server.js        → Node.js backend
├── form.html        → Student registration form

---

## ⚙️ Features

* Register student (Name, Email, Course)
* Store data in MySQL database
* Fetch and display all students
* API endpoints for CRUD operations (Insert, Retrieve)
* Simple browser-based UI

---

## 🛢️ Database Setup

Open phpMyAdmin:

http://localhost/phpmyadmin

Run the following SQL:

```sql
CREATE DATABASE student_db;

USE student_db;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  email VARCHAR(100),
  course VARCHAR(50)
);
```

---

## 🔌 Backend Setup

### 1. Initialize Project

```bash
npm init -y
```

---

### 2. Install Dependencies

```bash
npm install express mysql2 cors
```

---

### 3. Configure Database in server.js

```javascript
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "student_db"
});
```

---

## ▶️ Running the Application

### Step 1: Start MySQL

Use XAMPP
Start:

* MySQL

---

### Step 2: Run Server

```bash
node server.js
```

You should see:

Server running on http://localhost:5000

---

### Step 3: Open Browser

```text
http://localhost:5000
```

👉 Displays list of students

---

### Step 4: Open Form

```text
http://localhost:5000/form
```

👉 Fill details and submit

---

## 🧪 API Endpoints

---

### ➕ Add Student

POST → http://localhost:5000/add-student

Body (JSON):

```json
{
  "name": "Kunal",
  "email": "kunal@gmail.com",
  "course": "B.Tech"
}
```

---

### 📋 Get All Students

GET → http://localhost:5000/students

---

## 🌐 Frontend (form.html)

* Simple HTML form
* Uses Fetch API to send POST request
* Displays success message

---

## 🎯 Application Flow

Browser/Form → Node.js API → MySQL → Response

---

## ⚠️ Common Issues

### 1. Cannot POST /students

* Use correct endpoint `/add-student`

---

### 2. Database connection failed

* Check MySQL username/password
* Ensure MySQL is running

---

### 3. CORS Error

* Add in server.js:

```javascript
app.use(cors());
```

---

## 💡 Learning Outcomes

* Express.js API creation
* MySQL database integration
* RESTful API usage
* Handling HTTP requests (GET, POST)
* Full-stack data flow

---

## 📌 Conclusion

This project demonstrates how Node.js can be used with MySQL to build a simple student registration system with API-based data handling and browser display.

---

## 🚀 Future Enhancements

* Add Update and Delete APIs
* Create React frontend
* Add validation and error handling
* Implement authentication

---
