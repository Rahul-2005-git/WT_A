package com.bookstore.model;
import jakarta.persistence.*;
import lombok.Data;
import java.math.BigDecimal;
@Data @Entity @Table(name = "books")
public class Book {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY) private Long id;
    @Column(nullable = false) private String title;
    private String author, category, description, coverImage;
    private BigDecimal price;
    private Integer stock = 10;
    private Double rating = 4.5;
}
