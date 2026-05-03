# Assignment 15 - College Complaint Management System (PHP + MySQL)

## Features
- **Student Login** – secure login with email/password
- **Complaint Page** – file complaints with category, subject, description
- **My Complaints** – students view their own complaints and status
- **Admin Login** – separate admin panel
- **Admin Dashboard** – list all complaints, filter by status, update status & add remarks

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8015
```

### Step 3: Open Browser
- Student: http://localhost:8015/student_login.php
- Admin: http://localhost:8015/admin_login.php

### Demo Credentials
| Role | Login | Password |
|------|-------|----------|
| Student | rahul@college.com | teacher123 |
| Admin | admin | teacher123 |
