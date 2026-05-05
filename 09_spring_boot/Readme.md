# 📦 Product Inventory Management System (Spring Boot + MongoDB + Security)

## 🚀 Project Overview

This project is a **Spring Boot-based Product Inventory Management System** that allows users to manage product details using **MongoDB** as the database. It includes **Basic Authentication** using Spring Security and provides REST APIs for CRUD operations.

---

## 🛠️ Tech Stack

- **Backend:** Spring Boot
- **Database:** MongoDB
- **Security:** Spring Security (Basic Authentication)
- **Build Tool:** Maven
- **Testing Tool:** Postman

---

## 📁 Project Structure

```
src/main/java/com/example/inventory
 ├── controller        # REST Controllers
 ├── model             # MongoDB Document (Product)
 ├── repository        # MongoRepository Interface
 ├── config            # Security Configuration
 └── InventoryApplication.java
```

---

## ⚙️ Setup Instructions

### 1️⃣ Clone the Repository

```
git clone <your-repo-url>
cd inventory
```

### 2️⃣ Configure MongoDB

Make sure MongoDB is running locally or use MongoDB Atlas.

Update `application.properties`:

```
spring.data.mongodb.uri=mongodb://localhost:27017/productdb
spring.data.mongodb.database=productdb

spring.security.user.name=admin
spring.security.user.password=admin123

server.port=8080
```

---

## ▶️ Run the Application

```
mvn spring-boot:run
```

Server will start at:

```
http://localhost:8080
```

---

## 🔐 Authentication

This project uses **Basic Authentication**.

| Username | Password |
| -------- | -------- |
| admin    | admin123 |

Use these credentials in Postman under the **Authorization → Basic Auth** section.

---

## 📡 API Endpoints

### ➕ Create Product

```
POST /api/products
```

**Body:**

```json
{
  "name": "Laptop",
  "price": 50000,
  "quantity": 10
}
```

---

### 📄 Get All Products

```
GET /api/products
```

---

### 🔍 Get Product by ID

```
GET /api/products/{id}
```

---

### ✏️ Update Product

```
PUT /api/products/{id}
```

**Body:**

```json
{
  "name": "Updated Laptop",
  "price": 55000,
  "quantity": 8
}
```

---

### ❌ Delete Product

```
DELETE /api/products/{id}
```

---

## 🧪 Testing with Postman

1. Open Postman
2. Select request type (GET, POST, etc.)
3. Enter API URL
4. Go to **Authorization → Basic Auth**
5. Enter:
   - Username: `admin`
   - Password: `admin123`

6. Send request

---

## 🧠 Features

- MongoDB integration with Spring Data
- RESTful API design
- Basic Authentication with Spring Security
- Full CRUD operations
- Clean layered architecture

---

## ⚡ Future Enhancements

- JWT Authentication
- Input Validation
- Exception Handling
- Swagger API Documentation
- Frontend (React/Angular)

---
