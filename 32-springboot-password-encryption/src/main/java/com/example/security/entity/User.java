// User.java — JPA Entity representing a registered user in the database

package com.example.security.entity;

import jakarta.persistence.*;
import lombok.Data;

@Entity
@Table(name = "users")         // Maps to 'users' table in H2/MySQL
@Data                          // Lombok: auto-generates getters, setters, toString
public class User {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY) // Auto-increment primary key
    private Long id;

    @Column(unique = true, nullable = false)
    private String username;

    @Column(nullable = false)
    private String password;   // Will store BCrypt-encoded hash, NOT plaintext
}
