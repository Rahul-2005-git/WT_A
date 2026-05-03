# Assignment 11 - PHP Session Limiter (Max 3 Sessions, 5-Min Timeout)

## Features
- Limits each user to maximum **3 concurrent sessions**
- Sessions expire after **5 minutes** of inactivity
- Tracks sessions in MySQL database
- Visual session dashboard showing active sessions and time remaining

## Setup & Run

### Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx or PHP built-in server

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Configure DB (if needed)
Edit `db.php` and set your MySQL credentials.

### Step 3: Run
```bash
php -S localhost:8011
```

### Step 4: Open browser
Go to: http://localhost:8011/login.php

**Demo Credentials:**
- Username: `student1` or `student2`
- Password: `password`

Open 3 browser tabs/incognito windows to test session limit!
