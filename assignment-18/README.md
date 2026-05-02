# Assignment 18 - Complaint Management System (PHP + MySQL)

## Features
- Register & Login as citizen
- File complaints against multiple organizations: **PMC, PMT, MSEB, Pune Police, University of Pune**
- Dynamic complaint types based on selected organization
- Priority levels: Low, Medium, High, Critical
- Unique tracking ID generated per complaint
- View all your complaints with status

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8018
```

### Step 3: Open Browser
http://localhost:8018

Register a new account, then file complaints against any organization.
