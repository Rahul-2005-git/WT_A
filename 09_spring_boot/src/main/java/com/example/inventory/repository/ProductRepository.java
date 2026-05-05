package com.example.inventory.repository;

import org.springframework.data.mongodb.repository.MongoRepository;
import com.example.inventory.model.Product;

public interface ProductRepository extends MongoRepository<Product, String> {
}