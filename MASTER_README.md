# PHP & Web Development Assignments (11–20)

A collection of 10 complete web development assignments covering PHP, MySQL, ReactJS, and Spring Boot.

---

## 📁 Assignment Overview

| # | Title | Tech Stack | Port |
|---|-------|-----------|------|
| 11 | Session Limiter (Max 3 sessions, 5-min timeout) | PHP + MySQL | 8011 |
| 12 | Attendance System | PHP + MySQL | 8012 |
| 13 | Login Module with Cookies & Sessions | PHP + MySQL | 8013 |
| 14 | Online Bookstore | Spring Boot + MySQL | 8014 |
| 15 | College Complaint Registration | PHP + MySQL | 8015 |
| 16 | Currency Converter | ReactJS (CDN) | 8016 |
| 17 | Waste Collection System | PHP + MySQL | 8017 |
| 18 | Complaint Management (PMC/PMT) | PHP + MySQL | 8018 |
| 19 | Airplane Seat Booking | PHP + MySQL | 8019 |
| 20 | Tic-Tac-Toe Game | PHP (sessions) | 8020 |

---

## 🚀 Quick Start (Run All)

Each assignment lives in its own folder and can be cloned independently.

### Prerequisites
- PHP 7.4+ (`php -v`)
- MySQL 5.7+ (`mysql --version`)
- Java 17+ & Maven (Assignment 14 only)
- Modern web browser

### Run any assignment:
```bash
cd assignment-XX
mysql -u root -p < schema.sql   # (skip for 16 and 20)
php -S localhost:80XX
```

---

## 🐙 GitHub — Clone Individually

Each assignment is structured to be pushed as its own GitHub repository.

### Push a single assignment to GitHub:
```bash
cd assignment-11
git init
git add .
git commit -m "Assignment 11: Session limiter with max 3 concurrent sessions"
git remote add origin https://github.com/YOUR_USERNAME/assignment-11.git
git push -u origin main
```

Repeat for each assignment (changing the number).

---

## 📋 Detailed Run Instructions

### Assignment 11 — Session Limiter
```bash
cd assignment-11
mysql -u root -p < schema.sql
php -S localhost:8011
# Open: http://localhost:8011/login.php
# Test: Open 3 browser tabs — 4th login should be blocked
```

### Assignment 12 — Attendance System
```bash
cd assignment-12
mysql -u root -p < schema.sql
php -S localhost:8012
# Student: http://localhost:8012/student_register.php
# Teacher: http://localhost:8012/teacher_login.php
```

### Assignment 13 — Login with Cookies
```bash
cd assignment-13
mysql -u root -p < schema.sql
php -S localhost:8013
# Open: http://localhost:8013
# Register → Login with "Remember Me" → Close browser → Reopen to test cookie
```

### Assignment 14 — Online Bookstore (Spring Boot)
```bash
cd assignment-14
# Edit src/main/resources/application.properties for your MySQL credentials
mvn spring-boot:run
# Open: http://localhost:8014
```

### Assignment 15 — College Complaint System
```bash
cd assignment-15
mysql -u root -p < schema.sql
php -S localhost:8015
# Student: http://localhost:8015/student_login.php
# Admin:   http://localhost:8015/admin_login.php
```

### Assignment 16 — Currency Converter (React)
```bash
cd assignment-16
# Option A: Just open in browser
open index.html

# Option B: Serve it
php -S localhost:8016
# Open: http://localhost:8016
```

### Assignment 17 — Waste Collection
```bash
cd assignment-17
mysql -u root -p < schema.sql
php -S localhost:8017
# Open: http://localhost:8017
```

### Assignment 18 — Complaint Management (PMC/PMT)
```bash
cd assignment-18
mysql -u root -p < schema.sql
php -S localhost:8018
# Open: http://localhost:8018
```

### Assignment 19 — Airplane Seat Booking
```bash
cd assignment-19
mysql -u root -p < schema.sql
php -S localhost:8019
# Open: http://localhost:8019
```

### Assignment 20 — Tic-Tac-Toe
```bash
cd assignment-20
php -S localhost:8020
# Open: http://localhost:8020
# No database needed!
```
