# Assignment 19 - Airplane Seat Booking System (PHP + MySQL)

## 📌 Features
- List available flights with origin, destination, timings & prices
- Interactive **seat map** (Business & Economy classes)
- Color-coded seats:
  - 🟢 Available
  - 🟡 Selected
  - 🔴 Booked
- Book seats with passenger details
- Business Class (Rows 1–2)
- Economy Class (Rows 3–10)
- Unique **Booking Reference ID** generation
- Check booking status using reference number

---

## ⚙️ Requirements
- XAMPP (Apache + MySQL)
- PHP 7.4+
- MySQL 5.7+
- Web Browser (Chrome/Edge)

---

## 🚀 Setup & Run (Using XAMPP)

### 1️⃣ Start XAMPP
- Open XAMPP Control Panel
- Start:
  - Apache
  - MySQL

---

### 2️⃣ Copy Project Files
- Go to:

C:\xampp\htdocs\

- Create folder:

airplane-booking

- Paste all project files into this folder

---

### 3️⃣ Create Database
- Open browser:

http://localhost/phpmyadmin

- Click **Import**
- Select `schema.sql`
- Click **Go**

---

### 4️⃣ Configure Database Connection
- Open file: `db.php`
- Update credentials if needed:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "airplane_booking";

⚠️ Default XAMPP MySQL password is empty

5️⃣ Run Project

Open browser:

http://localhost/airplane-booking/
🧪 How to Use
✈️ Booking Process
Open homepage
View available flights
Select a flight
Choose seat from interactive seat map
Fill passenger details
Confirm booking
🎫 Booking Status Check
Enter booking reference ID
View booking details and status
🎨 Seat Map Details
Business Class: Rows 1–2
Economy Class: Rows 3–10

Color Codes:

🟢 Available → Can be selected
🟡 Selected → Chosen by user
🔴 Booked → Already reserved
📂 Project Structure
airplane-booking/
│── db.php
│── index.php
│── flights.php
│── seat_map.php
│── book_seat.php
│── booking_status.php
│── schema.sql