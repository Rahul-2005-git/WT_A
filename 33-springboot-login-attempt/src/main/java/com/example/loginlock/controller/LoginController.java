// LoginController.java — REST endpoints for registration and login

package com.example.loginlock.controller;

import com.example.loginlock.service.LoginService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api")
public class LoginController {

    @Autowired
    private LoginService loginService;

    // POST /api/register — { "username": "bob", "password": "pass123" }
    @PostMapping("/register")
    public Map<String, String> register(@RequestBody Map<String, String> body) {
        String result = loginService.register(body.get("username"), body.get("password"));
        return Map.of("message", result);
    }

    // POST /api/login — { "username": "bob", "password": "wrongpass" }
    @PostMapping("/login")
    public Map<String, String> login(@RequestBody Map<String, String> body) {
        String result = loginService.login(body.get("username"), body.get("password"));
        return Map.of("message", result);
    }
}
