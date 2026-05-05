package com.example.inventory.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import com.example.inventory.model.Product;
import com.example.inventory.repository.ProductRepository;

import java.util.List;

@RestController
@RequestMapping("/api/products")
public class ProductController {

    @Autowired
    private ProductRepository repo;

    // CREATE
    @PostMapping
    public Product addProduct(@RequestBody Product product) {
        return repo.save(product);
    }

    // READ ALL
    @GetMapping
    public List<Product> getAllProducts() {
        return repo.findAll();
    }

    // READ ONE
    @GetMapping("/{id}")
    public Product getProduct(@PathVariable String id) {
        return repo.findById(id).orElse(null);
    }

    // UPDATE
    @PutMapping("/{id}")
    public Product updateProduct(@PathVariable String id, @RequestBody Product p) {
        Product existing = repo.findById(id).orElse(null);
        if (existing != null) {
            existing.setName(p.getName());
            existing.setPrice(p.getPrice());
            existing.setQuantity(p.getQuantity());
            return repo.save(existing);
        }
        return null;
    }

    // DELETE
    @DeleteMapping("/{id}")
    public String deleteProduct(@PathVariable String id) {
        repo.deleteById(id);
        return "Deleted Successfully";
    }
}