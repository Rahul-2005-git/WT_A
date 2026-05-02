// server.js — Express application entry point

const express = require('express');
const app     = express();
const PORT    = process.env.PORT || 3000;

// ===== Middleware =====
app.use(express.json()); // Parse JSON request bodies

// ===== Routes =====
app.use('/api/blogs', require('./routes/blogRoutes'));

// Root endpoint — health check
app.get('/', (req, res) => {
  res.json({ message: '📝 Blog API is running!', version: '1.0.0' });
});

// 404 handler — for unknown routes
app.use((req, res) => {
  res.status(404).json({ error: 'Route not found.' });
});

// Global error handler
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Internal server error.' });
});

// ===== Start Server =====
app.listen(PORT, () => {
  console.log(`✅ Blog API running at http://localhost:${PORT}`);
});
