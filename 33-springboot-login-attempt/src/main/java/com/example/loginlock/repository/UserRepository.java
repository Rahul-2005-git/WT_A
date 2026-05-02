// UserRepository.java — JPA repository for user data access

package com.example.loginlock.repository;

import com.example.loginlock.entity.User;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface UserRepository extends JpaRepository<User, Long> {
    Optional<User> findByUsername(String username);
}
