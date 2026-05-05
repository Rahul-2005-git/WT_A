package com.example.ordermanagement.controller;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import com.example.ordermanagement.entity.Order;
import com.example.ordermanagement.service.OrderService;

@RestController
@RequestMapping("/orders")
public class OrderController {

    @Autowired
    private OrderService service;

    @PostMapping
    public Order create(@RequestBody Order order) {
        return service.createOrder(order);
    }

    @GetMapping
    public List<Order> getAll() {
        return service.getAllOrders();
    }

    @GetMapping("/{id}")
    public Order getById(@PathVariable Long id) {
        return service.getOrderById(id);
    }

    @PutMapping("/{id}")
    public Order update(@PathVariable Long id, @RequestBody Order order) {
        return service.updateOrder(id, order);
    }

    @DeleteMapping("/{id}")
    public String delete(@PathVariable Long id) {
        service.deleteOrder(id);
        return "Order deleted successfully!";
    }
}