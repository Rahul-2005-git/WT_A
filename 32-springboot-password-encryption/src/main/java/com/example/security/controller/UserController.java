// UserController.java — REST endpoints for registration and login

package com.example.security.controller;

import com.example.security.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api/users")
public class UserController {

    @Autowired
    private UserService userService;

    /**
     * POST /api/users/register
     * Body: { "username": "alice", "password": "secret123" }
     * Saves user with BCrypt-encrypted password.
     */
    @PostMapping("/register")
    public Map<String, String> register(@RequestBody Map<String, String> body) {
        String result = userService.register(body.get("username"), body.get("password"));
        return Map.of("message", result);
    }

    /**
     * POST /api/users/login
     * Body: { "username": "alice", "password": "secret123" }
     * Compares raw password with stored BCrypt hash.
     */
    @PostMapping("/login")
    public Map<String, String> login(@RequestBody Map<String, String> body) {
        String result = userService.login(body.get("username"), body.get("password"));
        return Map.of("message", result);
    }
}
