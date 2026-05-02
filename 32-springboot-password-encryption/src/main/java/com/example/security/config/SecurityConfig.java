// SecurityConfig.java — Configure Spring Security and BCrypt bean

package com.example.security.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
public class SecurityConfig {

    /**
     * BCryptPasswordEncoder:
     * - Hashes passwords with a salt using the BCrypt algorithm
     * - Strength factor 10 means 2^10 = 1024 rounds of hashing (slow by design)
     * - Same password gives DIFFERENT hashes each time (due to salt) — that's secure!
     */
    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder(10); // strength = 10 (default, recommended)
    }

    /**
     * Disable default Spring Security login page so our REST endpoints work freely.
     * In production, you'd configure JWT or session-based auth here.
     */
    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable())           // Disable CSRF for REST API testing
            .authorizeHttpRequests(auth -> auth
                .anyRequest().permitAll()           // Allow all endpoints (for demo)
            );
        return http.build();
    }
}
