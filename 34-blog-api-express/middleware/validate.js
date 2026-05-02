// middleware/validate.js — Request validation middleware

/**
 * Validates blog creation body.
 * Ensures required fields (title, content) are present and non-empty.
 */
const validateBlog = (req, res, next) => {
  const { title, content } = req.body;

  if (!title || typeof title !== 'string' || title.trim() === '') {
    return res.status(400).json({ error: 'Field "title" is required and must be a non-empty string.' });
  }

  if (!content || typeof content !== 'string' || content.trim() === '') {
    return res.status(400).json({ error: 'Field "content" is required and must be a non-empty string.' });
  }

  next(); // Validation passed — proceed to controller
};

module.exports = { validateBlog };
