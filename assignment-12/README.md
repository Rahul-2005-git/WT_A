# Assignment 12 - Attendance System (PHP + MySQL)

## Features
- **Student Registration** – self-registration with roll no, name, email, class
- **Teacher Attendance** – take attendance with checkboxes, roll no & name displayed
- **Student Dashboard** – view personal attendance records and percentage
- Date & subject selection for each attendance session

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8012
```

### Step 3: Open Browser
- Student Register: http://localhost:8012/student_register.php
- Student Login: http://localhost:8012/student_login.php
- Teacher Login: http://localhost:8012/teacher_login.php

### Demo Credentials
| Role | Email | Password |
|------|-------|----------|
| Teacher | sharma@college.com | teacher123 |
| Student | rahul@student.com | teacher123 |
