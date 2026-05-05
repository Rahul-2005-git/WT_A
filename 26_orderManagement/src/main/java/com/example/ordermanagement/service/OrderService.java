package com.example.ordermanagement.service;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.example.ordermanagement.entity.Order;
import com.example.ordermanagement.repository.OrderRepository;

@Service
public class OrderService {

    @Autowired
    private OrderRepository repo;

    public Order createOrder(Order order) {
        return repo.save(order);
    }

    public List<Order> getAllOrders() {
        return repo.findAll();
    }

    public Order getOrderById(Long id) {
        return repo.findById(id).orElse(null);
    }

    public Order updateOrder(Long id, Order newOrder) {
        Order order = repo.findById(id).orElse(null);
        if (order != null) {
            order.setProductName(newOrder.getProductName());
            order.setQuantity(newOrder.getQuantity());
            order.setPrice(newOrder.getPrice());
            order.setStatus(newOrder.getStatus());
            return repo.save(order);
        }
        return null;
    }

    public void deleteOrder(Long id) {
        repo.deleteById(id);
    }
}