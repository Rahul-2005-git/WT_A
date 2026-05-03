// package com._9.demo;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import com._9.demo.model.Product;
import com._9.demo.service.ProductService;

@RestController
@RequestMapping("/products")
public class ProductController {

    @Autowired
    private ProductService service;

    @PostMapping
    public Product addProduct(@RequestBody Product product) {
        return service.save(product);
    }

    @GetMapping
    public List<Product> getAllProducts() {
        return service.getAll();
    }

    @GetMapping("/{id}")
    public Product getProduct(@PathVariable String id) {
        return service.getById(id);
    }

    @PutMapping("/{id}")
    public Product updateProduct(@PathVariable String id, @RequestBody Product product) {
        return service.update(id, product);
    }

    @DeleteMapping("/{id}")
    public String deleteProduct(@PathVariable String id) {
        service.delete(id);
        return "Deleted successfully";
    }
}