package com.bookstore.config;
import com.bookstore.model.Book;
import com.bookstore.repository.BookRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.CommandLineRunner;
import org.springframework.stereotype.Component;
import java.math.BigDecimal;

@Component
public class DataInitializer implements CommandLineRunner {
    @Autowired private BookRepository bookRepo;

    @Override
    public void run(String... args) {
        if (bookRepo.count() == 0) {
            String[][] books = {
                {"The Great Gatsby", "F. Scott Fitzgerald", "Fiction", "299.00"},
                {"Clean Code", "Robert C. Martin", "Technology", "649.00"},
                {"Sapiens", "Yuval Noah Harari", "History", "499.00"},
                {"Atomic Habits", "James Clear", "Self-Help", "399.00"},
                {"A Brief History of Time", "Stephen Hawking", "Science", "349.00"},
                {"The Pragmatic Programmer", "Andrew Hunt", "Technology", "749.00"},
                {"To Kill a Mockingbird", "Harper Lee", "Fiction", "279.00"},
                {"Thinking, Fast and Slow", "Daniel Kahneman", "Self-Help", "449.00"},
                {"1984", "George Orwell", "Fiction", "199.00"},
                {"The Selfish Gene", "Richard Dawkins", "Science", "379.00"},
                {"Design Patterns", "Gang of Four", "Technology", "899.00"},
                {"Educated", "Tara Westover", "History", "329.00"}
            };
            for (String[] b : books) {
                Book book = new Book();
                book.setTitle(b[0]); book.setAuthor(b[1]);
                book.setCategory(b[2]); book.setPrice(new BigDecimal(b[3]));
                bookRepo.save(book);
            }
        }
    }
}
