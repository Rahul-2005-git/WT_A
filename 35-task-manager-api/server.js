// server.js — Task Manager API entry point

const express = require('express');
const app     = express();
const PORT    = process.env.PORT || 3001;

// Middleware: parse JSON bodies
app.use(express.json());

// Routes
app.use('/api/tasks', require('./routes/taskRoutes'));

// Health check
app.get('/', (req, res) => {
  res.json({ message: '✅ Task Manager API running!', version: '1.0.0' });
});

// 404
app.use((req, res) => res.status(404).json({ error: 'Route not found.' }));

// Error handler
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Server error.' });
});

app.listen(PORT, () => {
  console.log(`📋 Task Manager API at http://localhost:${PORT}`);
});
