console.log("Server file started...");

const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();

// Middleware
app.use(cors());
app.use(express.json());

// ================= DB CONNECTION =================
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "Kunal@1975",   // change if you have password
    database: "student_db"
});

db.connect((err) => {
    if (err) {
        console.log("❌ Database connection failed:", err);
    } else {
        console.log("✅ Connected to MySQL");
    }
});

// ================= INSERT STUDENT =================
app.post("/add-student", (req, res) => {
    const { name, email, course } = req.body;

    if (!name || !email || !course) {
        return res.status(400).send("All fields are required");
    }

    const sql = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";

    db.query(sql, [name, email, course], (err, result) => {
        if (err) {
            console.log(err);
            res.status(500).send("Error inserting data");
        } else {
            res.send("✅ Student added successfully");
        }
    });
});

// ================= GET ALL STUDENTS =================
app.get("/students", (req, res) => {
    const sql = "SELECT * FROM students";

    db.query(sql, (err, result) => {
        if (err) {
            console.log(err);
            res.status(500).send("Error fetching data");
        } else {
            res.json(result);
        }
    });
});

// ================= DISPLAY IN BROWSER =================
app.get("/", (req, res) => {
    const sql = "SELECT * FROM students";

    db.query(sql, (err, result) => {
        if (err) {
            return res.send("Error loading students");
        }

        let html = `
      <h2 style="text-align:center;">Student List</h2>
      <table border="1" cellpadding="10" style="margin:auto;">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
      </tr>
    `;

        result.forEach((row) => {
            html += `
        <tr>
          <td>${row.id}</td>
          <td>${row.name}</td>
          <td>${row.email}</td>
          <td>${row.course}</td>
        </tr>
      `;
        });

        html += "</table>";

        res.send(html);
    });
});

app.listen(5000, () => {
    console.log("🚀 Server running on http://localhost:5000");
});