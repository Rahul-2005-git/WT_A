// controllers/taskController.js — Business logic for task operations

const taskModel = require('../models/taskModel');

// GET /api/tasks — Get all tasks (optionally filter by ?status=pending)
const getAllTasks = (req, res) => {
  let tasks = taskModel.getAll();
  const { status } = req.query;

  if (status) {
    tasks = tasks.filter(t => t.status === status);
  }

  res.status(200).json({ success: true, count: tasks.length, data: tasks });
};

// POST /api/tasks — Add a new task
// Body: { "title": "My Task" }
const addTask = (req, res) => {
  const { title } = req.body;

  if (!title || title.trim() === '') {
    return res.status(400).json({ error: 'Field "title" is required.' });
  }

  const task = taskModel.create(title.trim());
  res.status(201).json({ success: true, message: 'Task created.', data: task });
};

// PATCH /api/tasks/:id/status — Update task status (completed | pending)
const updateTaskStatus = (req, res) => {
  const { status } = req.body;

  if (!['completed', 'pending'].includes(status)) {
    return res.status(400).json({ error: 'Status must be "completed" or "pending".' });
  }

  const task = taskModel.updateStatus(req.params.id, status);

  if (!task) {
    return res.status(404).json({ error: 'Task not found.' });
  }

  res.status(200).json({ success: true, message: `Task marked as ${status}.`, data: task });
};

// DELETE /api/tasks/completed — Delete all completed tasks
const deleteCompletedTasks = (req, res) => {
  const count = taskModel.deleteCompleted();
  res.status(200).json({ success: true, message: `${count} completed task(s) deleted.` });
};

// DELETE /api/tasks/:id — Delete a specific task by id
const deleteTask = (req, res) => {
  const deleted = taskModel.deleteById(req.params.id);

  if (!deleted) {
    return res.status(404).json({ error: 'Task not found.' });
  }

  res.status(200).json({ success: true, message: 'Task deleted.' });
};

module.exports = { getAllTasks, addTask, updateTaskStatus, deleteCompletedTasks, deleteTask };
