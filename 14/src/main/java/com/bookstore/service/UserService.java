package com.bookstore.service;
import com.bookstore.model.User;
import com.bookstore.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class UserService {
    @Autowired private UserRepository userRepo;
    @Autowired private BCryptPasswordEncoder passwordEncoder;

    public User register(User user) {
        if (userRepo.existsByEmail(user.getEmail())) throw new RuntimeException("Email already registered");
        user.setPassword(passwordEncoder.encode(user.getPassword()));
        return userRepo.save(user);
    }
}
