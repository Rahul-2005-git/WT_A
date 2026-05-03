# Assignment 14 - Online Bookstore (Spring Boot + MySQL)

## Pages
1. **Home Page** – Hero banner + featured books grid
2. **Login Page** – Email/password login
3. **Catalog Page** – All books with search & category filter
4. **Registration Page** – New user signup stored in MySQL

## Prerequisites
- Java 17+
- Maven 3.6+
- MySQL 5.7+

## Setup & Run

### Step 1: Create MySQL Database
```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS bookstore_db;"
```

### Step 2: Configure Database (if different credentials)
Edit `src/main/resources/application.properties` and update:
```properties
spring.datasource.username=root
spring.datasource.password=your_password
```

### Step 3: Build & Run
```bash
mvn spring-boot:run
```

### Step 4: Open Browser
http://localhost:8014

**Register a new account, then explore the catalog!**

> Books are auto-seeded on first launch (12 sample books across categories).
