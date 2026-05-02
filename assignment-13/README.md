# Assignment 13 - PHP Login Module with Cookies & Sessions

## Features
- **User Registration** with password validation
- **Login Form** with username/email support
- **Remember Me** – stores encrypted token in cookie (30 days)
- **Session Management** – PHP sessions track logged-in users
- **MySQL Database** – users stored with hashed passwords
- Auto-login via remember-me cookie on return visits

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8013
```

### Step 3: Open Browser
http://localhost:8013

**Register a new account, then login with "Remember Me" checked, then close and reopen the browser to test cookie-based auto-login!**
