package com.bookstore.controller;
import com.bookstore.model.*;
import com.bookstore.repository.BookRepository;
import com.bookstore.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
public class HomeController {
    @Autowired private BookRepository bookRepo;
    @Autowired private UserService userService;

    @GetMapping({"/", "/home"})
    public String home(Model model) {
        model.addAttribute("featuredBooks", bookRepo.findAll().stream().limit(6).toList());
        return "home";
    }

    @GetMapping("/catalog")
    public String catalog(@RequestParam(required = false) String search,
                           @RequestParam(required = false) String category, Model model) {
        var books = (search != null && !search.isEmpty()) ? bookRepo.findByTitleContainingIgnoreCase(search) :
                    (category != null && !category.isEmpty()) ? bookRepo.findByCategory(category) :
                    bookRepo.findAll();
        model.addAttribute("books", books);
        model.addAttribute("search", search);
        model.addAttribute("category", category);
        return "books/catalog";
    }

    @GetMapping("/register")
    public String registerForm(Model model) { model.addAttribute("user", new User()); return "auth/register"; }

    @PostMapping("/register")
    public String register(@ModelAttribute User user, Model model) {
        try { userService.register(user); return "redirect:/login?registered"; }
        catch (Exception e) { model.addAttribute("error", e.getMessage()); return "auth/register"; }
    }

    @GetMapping("/login") public String login() { return "auth/login"; }
}
