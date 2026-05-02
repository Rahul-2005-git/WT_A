# Full-Stack Development Assignments 31–35

A collection of production-ready implementations covering React, Spring Boot, and Express.js.

---

## 📁 Projects Overview

| # | Project | Tech Stack | Port |
|---|---------|------------|------|
| 31 | Redux Notification System | React + Redux Toolkit | 3000 |
| 32 | Password Encryption | Spring Boot + BCrypt + H2 | 8080 |
| 33 | Login Attempt Restriction | Spring Boot + Spring Security | 8080 |
| 34 | Blog Management REST API | Express.js (MVC) | 3000 |
| 35 | Task Manager REST API | Express.js (MVC) | 3001 |

---

## 🚀 Quick Start

### Assignment 31 — React Redux Notifications
```bash
cd 31-react-redux-notifications
npm install
npm start
# Opens at http://localhost:3000
```

### Assignment 32 — Spring Boot Password Encryption
```bash
cd 32-springboot-password-encryption
mvn spring-boot:run
# API at http://localhost:8080
# H2 Console at http://localhost:8080/h2-console
```

### Assignment 33 — Spring Boot Login Attempt Restriction
```bash
cd 33-springboot-login-attempt
mvn spring-boot:run
# API at http://localhost:8080
```

### Assignment 34 — Blog REST API
```bash
cd 34-blog-api-express
npm install
npm run dev
# API at http://localhost:3000/api/blogs
```

### Assignment 35 — Task Manager REST API
```bash
cd 35-task-manager-api
npm install
npm run dev
# API at http://localhost:3001/api/tasks
```

---

## 🔧 Prerequisites

- **Node.js** 18+ and **npm** → for Assignments 31, 34, 35
- **Java** 17+ and **Maven** 3.6+ → for Assignments 32, 33

---

## 📌 API Endpoints

### Assignment 34 — Blog API
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/blogs` | Get all blogs |
| GET | `/api/blogs/:id` | Get blog by ID |
| POST | `/api/blogs` | Create blog |
| PUT | `/api/blogs/:id` | Update blog |
| DELETE | `/api/blogs/:id` | Delete blog |

### Assignment 35 — Task API
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | Get all tasks |
| POST | `/api/tasks` | Add task |
| PATCH | `/api/tasks/:id/status` | Update status |
| DELETE | `/api/tasks/completed` | Delete all completed |
| DELETE | `/api/tasks/:id` | Delete task |

---

## 👨‍💻 Tech Stack
- **React 18** + **Redux Toolkit** + **react-redux**
- **Spring Boot 3.2** + **Spring Security** + **Spring Data JPA** + **H2**
- **Express.js 4** + **UUID** + **Nodemon**
