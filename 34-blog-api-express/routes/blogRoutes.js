// routes/blogRoutes.js — Route definitions (MVC: Route/View layer)

const express = require('express');
const router  = express.Router();

const {
  getAllBlogs, getBlogById, createBlog, updateBlog, deleteBlog
} = require('../controllers/blogController');

const { validateBlog } = require('../middleware/validate');

// RESTful routes following clean naming convention
router.get('/',          getAllBlogs);           // GET    /api/blogs
router.get('/:id',       getBlogById);           // GET    /api/blogs/:id
router.post('/',         validateBlog, createBlog); // POST   /api/blogs
router.put('/:id',       updateBlog);            // PUT    /api/blogs/:id
router.delete('/:id',    deleteBlog);            // DELETE /api/blogs/:id

module.exports = router;
