package com._9.demo.repository;

import org.springframework.data.mongodb.repository.MongoRepository;
import com._9.demo.model.Product;

public interface ProductRepository extends MongoRepository<Product, String> {
}