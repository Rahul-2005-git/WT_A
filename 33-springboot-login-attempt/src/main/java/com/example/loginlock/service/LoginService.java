// LoginService.java — Core logic: tracking failed attempts and locking accounts

package com.example.loginlock.service;

import com.example.loginlock.entity.User;
import com.example.loginlock.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import java.time.LocalDateTime;
import java.util.Optional;

@Service
public class LoginService {

    // Maximum failed attempts before locking
    private static final int MAX_ATTEMPTS = 3;

    // Lock duration: 5 minutes
    private static final int LOCK_DURATION_MINUTES = 5;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    /**
     * Register a new user (passwords are BCrypt-encoded on save).
     */
    public String register(String username, String rawPassword) {
        if (userRepository.findByUsername(username).isPresent()) {
            return "Username already taken!";
        }
        User user = new User();
        user.setUsername(username);
        user.setPassword(passwordEncoder.encode(rawPassword));
        userRepository.save(user);
        return "User registered successfully.";
    }

    /**
     * Login with attempt tracking:
     * 1. Check if user exists
     * 2. Check if account is locked — auto-unlock if lock duration has passed
     * 3. Validate password
     * 4. On success: reset failed attempts
     * 5. On failure: increment counter, lock after MAX_ATTEMPTS
     */
    public String login(String username, String rawPassword) {
        Optional<User> optUser = userRepository.findByUsername(username);

        if (optUser.isEmpty()) {
            return "❌ User not found.";
        }

        User user = optUser.get();

        // === Check if account is locked ===
        if (user.isAccountLocked()) {
            LocalDateTime unlockTime = user.getLockTime().plusMinutes(LOCK_DURATION_MINUTES);

            if (LocalDateTime.now().isBefore(unlockTime)) {
                // Still locked
                long minutesLeft = java.time.Duration.between(LocalDateTime.now(), unlockTime).toMinutes() + 1;
                return "🔒 Account locked! Try again in " + minutesLeft + " minute(s).";
            } else {
                // Lock duration expired — auto-unlock
                unlockAccount(user);
            }
        }

        // === Validate password ===
        if (passwordEncoder.matches(rawPassword, user.getPassword())) {
            // Successful login — reset counter
            user.setFailedAttempts(0);
            user.setLockTime(null);
            userRepository.save(user);
            return "✅ Login successful! Welcome, " + username;
        } else {
            // Wrong password
            int attempts = user.getFailedAttempts() + 1;
            user.setFailedAttempts(attempts);

            if (attempts >= MAX_ATTEMPTS) {
                // Lock the account
                user.setLockTime(LocalDateTime.now());
                userRepository.save(user);
                return "❌ Wrong password. Account LOCKED after " + MAX_ATTEMPTS +
                       " failed attempts. Unlock in " + LOCK_DURATION_MINUTES + " minutes.";
            } else {
                userRepository.save(user);
                int remaining = MAX_ATTEMPTS - attempts;
                return "❌ Wrong password. " + remaining + " attempt(s) remaining before lockout.";
            }
        }
    }

    // Helper: reset lock fields
    private void unlockAccount(User user) {
        user.setFailedAttempts(0);
        user.setLockTime(null);
        userRepository.save(user);
    }
}
