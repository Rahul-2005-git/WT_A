# GitHub Setup Guide — Push Each Assignment Separately

This guide shows how to push each assignment as its own GitHub repository,
so each can be cloned independently with: `git clone https://github.com/YOUR_USERNAME/assignment-XX.git`

---

## Step 1: Create GitHub Repositories

Go to https://github.com/new and create these repos (one at a time):
- `assignment-11`
- `assignment-12`
- `assignment-13`
- `assignment-14`
- `assignment-15`
- `assignment-16`
- `assignment-17`
- `assignment-18`
- `assignment-19`
- `assignment-20`

> ✅ Keep them **Public** so they can be cloned freely.
> ❌ Do NOT add README/gitignore during creation (we already have them).

---

## Step 2: Configure Git (first time only)

```bash
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

---

## Step 3: Push Each Assignment

Replace `YOUR_USERNAME` with your actual GitHub username.

### Assignment 11
```bash
cd assignment-11
git init
git add .
git commit -m "Assignment 11: PHP Session Limiter - max 3 concurrent sessions, 5-min timeout"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-11.git
git push -u origin main
```

### Assignment 12
```bash
cd ../assignment-12
git init
git add .
git commit -m "Assignment 12: Attendance System - Student registration + Teacher online attendance"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-12.git
git push -u origin main
```

### Assignment 13
```bash
cd ../assignment-13
git init
git add .
git commit -m "Assignment 13: PHP Login Module with Cookies, Sessions, and MySQL"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-13.git
git push -u origin main
```

### Assignment 14
```bash
cd ../assignment-14
git init
git add .
git commit -m "Assignment 14: Online Bookstore - Spring Boot + MySQL (Home, Login, Catalog, Register)"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-14.git
git push -u origin main
```

### Assignment 15
```bash
cd ../assignment-15
git init
git add .
git commit -m "Assignment 15: College Complaint Registration System - PHP + MySQL"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-15.git
git push -u origin main
```

### Assignment 16
```bash
cd ../assignment-16
git init
git add .
git commit -m "Assignment 16: Currency Converter - ReactJS (USD to INR with live rates)"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-16.git
git push -u origin main
```

### Assignment 17
```bash
cd ../assignment-17
git init
git add .
git commit -m "Assignment 17: Waste Collection System - PHP + MySQL with authority auto-assignment"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-17.git
git push -u origin main
```

### Assignment 18
```bash
cd ../assignment-18
git init
git add .
git commit -m "Assignment 18: Complaint Management System (PMC, PMT, MSEB) - PHP + MySQL"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-18.git
git push -u origin main
```

### Assignment 19
```bash
cd ../assignment-19
git init
git add .
git commit -m "Assignment 19: Airplane Seat Booking System - PHP + MySQL with interactive seat map"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-19.git
git push -u origin main
```

### Assignment 20
```bash
cd ../assignment-20
git init
git add .
git commit -m "Assignment 20: Tic-Tac-Toe Game - PHP with session-based state and CPU AI"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/assignment-20.git
git push -u origin main
```

---

## Step 4: Clone Any Assignment (from anywhere)

Once pushed, anyone can clone a specific assignment:

```bash
# Clone assignment 19 (Airplane Booking)
git clone https://github.com/YOUR_USERNAME/assignment-19.git
cd assignment-19
mysql -u root -p < schema.sql
php -S localhost:8019
```

---

## 💡 Batch Push Script (run all at once)

Save this as `push_all.sh` and run it from the parent folder:

```bash
#!/bin/bash
USERNAME="YOUR_GITHUB_USERNAME"
TITLES=(
  "" # placeholder for index 0
  "" # placeholder for 1-10
  "PHP Session Limiter - max 3 concurrent sessions"
  "Attendance System - Student registration and Teacher attendance"
  "PHP Login Module with Cookies Sessions and MySQL"
  "Online Bookstore - Spring Boot MySQL"
  "College Complaint Registration System"
  "Currency Converter ReactJS USD to INR"
  "Waste Collection System PHP MySQL"
  "Complaint Management System PMC PMT"
  "Airplane Seat Booking System"
  "Tic-Tac-Toe Game PHP"
)

for i in {11..20}; do
  echo "Pushing assignment-$i..."
  cd assignment-$i
  git init
  git add .
  git commit -m "Assignment $i: ${TITLES[$i]}"
  git branch -M main
  git remote add origin "https://github.com/$USERNAME/assignment-$i.git"
  git push -u origin main
  cd ..
done
echo "All assignments pushed!"
```

```bash
chmod +x push_all.sh
./push_all.sh
```
