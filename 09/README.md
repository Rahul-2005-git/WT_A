# 🛒 Product Inventory Management System

A Spring Boot-based backend application that manages product inventory using MongoDB. It supports secure CRUD operations with Basic Authentication.

---

## 🚀 Tech Stack

* Java (Spring Boot)
* Spring Data MongoDB
* Spring Security (Basic Authentication)
* MongoDB (NoSQL Database)
* Maven (Build Tool)
* Postman / Browser (Testing)

---

## 📁 Project Structure

com._9.demo
│
├── DemoApplication.java
├── controller/ → REST APIs
├── service/ → Business logic
├── repository/ → MongoDB access
├── model/ → Product document
├── config/ → Security configuration

---

## ⚙️ Features

* Add new products
* View all products
* View product by ID
* Update product
* Delete product
* Secured APIs using Basic Authentication

---

## 🔐 Default Credentials

Username: admin
Password: admin123

---

## 🧱 API Endpoints

| Method | Endpoint       | Description       |
| ------ | -------------- | ----------------- |
| GET    | /products      | Get all products  |
| GET    | /products/{id} | Get product by ID |
| POST   | /products      | Add product       |
| PUT    | /products/{id} | Update product    |
| DELETE | /products/{id} | Delete product    |

---

## 🛠️ Setup Instructions

### 1. Clone / Extract Project

Unzip the downloaded project or clone it:

git clone <repo-url>
cd demo

---

### 2. Run MongoDB

Make sure MongoDB is installed and running:

mongod

---

### 3. Configure Application

File: src/main/resources/application.properties

spring.data.mongodb.uri=mongodb://localhost:27017/productdb
spring.data.mongodb.database=productdb

spring.security.user.name=admin
spring.security.user.password=admin123

server.port=8080

---

### 4. Run Application

Using Maven Wrapper:

.\mvnw spring-boot:run

---

### 5. Verify Server

Open browser:

http://localhost:8080/products

Login with credentials → you should see:

[]

---

## 🧪 Testing APIs

### 🔹 Using Browser

* Only GET requests can be tested

### 🔹 Using Postman

Use Basic Auth:

* Username: admin
* Password: admin123

#### Example POST Request

URL: http://localhost:8080/products
Method: POST

Body (JSON):

{
"name": "Laptop",
"price": 50000,
"quantity": 10
}

---

## 🗄️ Verify Data in MongoDB

mongo
use productdb
db.products.find().pretty()

---

## ⚠️ Common Issues

### 401 Unauthorized

* Check username/password
* Ensure Authorization is set

### 404 Not Found

* Check URL (/products)
* Ensure controller package matches main package

### MongoDB not connecting

* Run mongod
* Check connection string

---

## 🎯 Conclusion

This project demonstrates:

* REST API development using Spring Boot
* MongoDB integration
* Secure API using Spring Security
* Full CRUD operations

---

## 🚀 Future Enhancements

* Add Swagger UI
* Implement JWT Authentication
* Add frontend (React)
* Deploy to cloud

---
