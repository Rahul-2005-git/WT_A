// UserRepository.java — Spring Data JPA repository for database operations

package com.example.security.repository;

import com.example.security.entity.User;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

// JpaRepository gives us: save(), findById(), findAll(), delete() — for free!
public interface UserRepository extends JpaRepository<User, Long> {

    // Custom query: Spring auto-generates SQL "SELECT * FROM users WHERE username = ?"
    Optional<User> findByUsername(String username);
}
