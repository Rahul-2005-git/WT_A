// routes/taskRoutes.js — Task API route definitions

const express = require('express');
const router  = express.Router();

const {
  getAllTasks, addTask, updateTaskStatus, deleteCompletedTasks, deleteTask
} = require('../controllers/taskController');

// Clean REST naming conventions
router.get('/',                 getAllTasks);           // GET    /api/tasks
router.post('/',                addTask);              // POST   /api/tasks
router.patch('/:id/status',     updateTaskStatus);     // PATCH  /api/tasks/:id/status
router.delete('/completed',     deleteCompletedTasks); // DELETE /api/tasks/completed
router.delete('/:id',           deleteTask);           // DELETE /api/tasks/:id

module.exports = router;
