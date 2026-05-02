const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

// ✅ MongoDB Connection (FIXED)
mongoose.connect("mongodb://127.0.0.1:27017/library_db")
.then(() => console.log("✅ MongoDB Connected"))
.catch(err => console.log("❌ Error:", err));

// Schema
const bookSchema = new mongoose.Schema({
    book_id: Number,
    title: String,
    author: String,
    year: Number
});

const Book = mongoose.model("Book", bookSchema);

// 🔹 Add Book API
app.post("/addBook", async (req, res) => {
    try {
        const book = new Book(req.body);
        await book.save();
        res.send("✅ Book Added Successfully");
    } catch (err) {
        res.status(500).send(err.message);
    }
});

// 🔹 Get All Books API
app.get("/books", async (req, res) => {
    try {
        const books = await Book.find();
        res.json(books);
    } catch (err) {
        res.status(500).send(err.message);
    }
});

// Start server
app.listen(5000, () => {
    console.log("🚀 Server running on http://localhost:5000");
});