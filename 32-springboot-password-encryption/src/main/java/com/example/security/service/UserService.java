// UserService.java — Business logic for registration and login

package com.example.security.service;

import com.example.security.entity.User;
import com.example.security.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import java.util.Optional;

@Service
public class UserService {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private PasswordEncoder passwordEncoder; // BCryptPasswordEncoder injected here

    /**
     * Register a new user.
     * Password is HASHED before saving — never stored as plaintext.
     */
    public String register(String username, String rawPassword) {
        // Check if username already exists
        if (userRepository.findByUsername(username).isPresent()) {
            return "Username already taken!";
        }

        User user = new User();
        user.setUsername(username);
        // BCrypt hash: $2a$10$<22-char-salt><31-char-hash>
        user.setPassword(passwordEncoder.encode(rawPassword));

        userRepository.save(user);
        return "User registered! Encrypted password saved in DB.";
    }

    /**
     * Login: compare raw password to stored BCrypt hash.
     * BCrypt.matches() re-hashes the input and compares — secure constant-time check.
     */
    public String login(String username, String rawPassword) {
        Optional<User> optionalUser = userRepository.findByUsername(username);

        if (optionalUser.isEmpty()) {
            return "User not found!";
        }

        User user = optionalUser.get();

        // passwordEncoder.matches(rawInput, storedHash) — returns true if they match
        if (passwordEncoder.matches(rawPassword, user.getPassword())) {
            return "✅ Login successful! Welcome, " + username;
        } else {
            return "❌ Invalid credentials!";
        }
    }
}
