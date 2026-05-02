// models/blogModel.js — In-memory data store for blogs

const { v4: uuidv4 } = require('uuid');

// In-memory array simulates a database
// In production, replace with MongoDB/MySQL calls
let blogs = [
  {
    id: uuidv4(),
    title: 'Getting Started with Express.js',
    content: 'Express.js is a minimal and flexible Node.js web framework...',
    author: 'Admin',
    createdAt: new Date().toISOString(),
    updatedAt: new Date().toISOString(),
  }
];

// === Model functions (like a simple DAO layer) ===

// Return all blogs
const getAll = () => blogs;

// Find blog by ID
const getById = (id) => blogs.find(b => b.id === id);

// Create a new blog
const create = ({ title, content, author }) => {
  const blog = {
    id: uuidv4(),
    title,
    content,
    author: author || 'Anonymous',
    createdAt: new Date().toISOString(),
    updatedAt: new Date().toISOString(),
  };
  blogs.push(blog);
  return blog;
};

// Update blog fields by ID
const update = (id, { title, content }) => {
  const index = blogs.findIndex(b => b.id === id);
  if (index === -1) return null;

  blogs[index] = {
    ...blogs[index],
    title:     title     ?? blogs[index].title,
    content:   content   ?? blogs[index].content,
    updatedAt: new Date().toISOString(),
  };
  return blogs[index];
};

// Delete blog by ID
const remove = (id) => {
  const index = blogs.findIndex(b => b.id === id);
  if (index === -1) return false;
  blogs.splice(index, 1);
  return true;
};

module.exports = { getAll, getById, create, update, remove };
