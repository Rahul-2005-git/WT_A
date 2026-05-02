# Assignment 17 - Waste Collection System (PHP + MySQL)

## Features
- Citizens can report waste (plastic, paper, metal, e-waste, etc.) at a location
- System auto-assigns nearest available PMC/authority team
- Schedules collection for next business day
- Displays recent requests with status tracking
- Shows how the process works step-by-step

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8017
```

### Step 3: Open Browser
http://localhost:8017
