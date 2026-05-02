// controllers/blogController.js — Request handlers (MVC: Controller layer)

const blogModel = require('../models/blogModel');

// GET /api/blogs — Fetch all blogs
const getAllBlogs = (req, res) => {
  const blogs = blogModel.getAll();
  res.status(200).json({
    success: true,
    count: blogs.length,
    data: blogs,
  });
};

// GET /api/blogs/:id — Fetch single blog by ID
const getBlogById = (req, res) => {
  const blog = blogModel.getById(req.params.id);

  if (!blog) {
    return res.status(404).json({ success: false, error: 'Blog not found.' });
  }

  res.status(200).json({ success: true, data: blog });
};

// POST /api/blogs — Create a new blog
const createBlog = (req, res) => {
  const blog = blogModel.create(req.body);
  res.status(201).json({
    success: true,
    message: 'Blog created successfully.',
    data: blog,
  });
};

// PUT /api/blogs/:id — Update an existing blog
const updateBlog = (req, res) => {
  const updated = blogModel.update(req.params.id, req.body);

  if (!updated) {
    return res.status(404).json({ success: false, error: 'Blog not found.' });
  }

  res.status(200).json({
    success: true,
    message: 'Blog updated successfully.',
    data: updated,
  });
};

// DELETE /api/blogs/:id — Delete a blog
const deleteBlog = (req, res) => {
  const deleted = blogModel.remove(req.params.id);

  if (!deleted) {
    return res.status(404).json({ success: false, error: 'Blog not found.' });
  }

  res.status(200).json({
    success: true,
    message: 'Blog deleted successfully.',
  });
};

module.exports = { getAllBlogs, getBlogById, createBlog, updateBlog, deleteBlog };
