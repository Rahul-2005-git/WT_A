package com.example.loginlock.entity;

import jakarta.persistence.*;
import java.time.LocalDateTime;


@Entity
public class User {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String username;
    private String password;

    private int failedAttempts;
    private LocalDateTime lockTime;

    // ✅ GETTERS & SETTERS

    public Long getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public int getFailedAttempts() {
        return failedAttempts;
    }

    public void setFailedAttempts(int failedAttempts) {
        this.failedAttempts = failedAttempts;
    }

    public LocalDateTime getLockTime() {
        return lockTime;
    }

    public void setLockTime(LocalDateTime lockTime) {
        this.lockTime = lockTime;
    }
 

public boolean isAccountLocked() {
    if (lockTime == null) return false;
    return lockTime.plusMinutes(5).isAfter(LocalDateTime.now());
}
}
