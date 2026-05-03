package com.bookstore.config;
import com.bookstore.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.*;
import org.springframework.security.authentication.dao.DaoAuthenticationProvider;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.core.userdetails.*;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;

@Configuration @EnableWebSecurity
public class SecurityConfig {
    @Autowired private UserRepository userRepo;

    @Bean public BCryptPasswordEncoder passwordEncoder() { return new BCryptPasswordEncoder(); }

    @Bean
    public UserDetailsService userDetailsService() {
        return email -> {
            var user = userRepo.findByEmail(email).orElseThrow(() -> new UsernameNotFoundException("User not found"));
            return User.withUsername(user.getEmail()).password(user.getPassword()).roles("USER").build();
        };
    }

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http.authorizeHttpRequests(auth -> auth
            .requestMatchers("/", "/home", "/catalog", "/register", "/login", "/css/**").permitAll()
            .anyRequest().authenticated())
        .formLogin(form -> form.loginPage("/login").defaultSuccessUrl("/home", true).permitAll())
        .logout(logout -> logout.logoutSuccessUrl("/login?logout").permitAll());
        return http.build();
    }

    @Bean
    public DaoAuthenticationProvider authProvider() {
        var p = new DaoAuthenticationProvider();
        p.setUserDetailsService(userDetailsService());
        p.setPasswordEncoder(passwordEncoder());
        return p;
    }
}
