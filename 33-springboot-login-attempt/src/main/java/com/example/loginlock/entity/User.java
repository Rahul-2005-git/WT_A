// User.java — Extended entity with failed login tracking and account locking

package com.example.loginlock.entity;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDateTime;

@Entity
@Table(name = "users")
@Data
public class User {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(unique = true, nullable = false)
    private String username;

    @Column(nullable = false)
    private String password;   // BCrypt-hashed

    // Number of consecutive failed login attempts
    private int failedAttempts = 0;

    // Timestamp when account was locked (null = not locked)
    private LocalDateTime lockTime;

    // Derived: is the account currently locked?
    public boolean isAccountLocked() {
        return lockTime != null;
    }
}
