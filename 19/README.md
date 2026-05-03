# Assignment 19 - Airplane Seat Booking System (PHP + MySQL)

## Features
- List available flights with origin, destination, times & prices
- Interactive **seat map** showing Business & Economy class seats
- Color-coded seats: Available / Selected / Booked
- Book a seat with passenger details
- Business Class (Rows 1-2) and Economy Class (Rows 3-10)
- Booking reference ID generation
- Check booking status by reference number

## Setup & Run

### Step 1: Create Database
```bash
mysql -u root -p < schema.sql
```

### Step 2: Run Server
```bash
php -S localhost:8019
```

### Step 3: Open Browser
http://localhost:8019
- Select a flight → Choose seat on the interactive map → Fill passenger details → Book!
