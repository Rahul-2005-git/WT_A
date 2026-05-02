// models/taskModel.js — In-memory task store

const { v4: uuidv4 } = require('uuid');

// In-memory tasks array (replace with DB in production)
let tasks = [
  { id: uuidv4(), title: 'Set up project', status: 'completed', createdAt: new Date().toISOString() },
  { id: uuidv4(), title: 'Write documentation', status: 'pending', createdAt: new Date().toISOString() },
];

const getAll = () => tasks;

const getById = (id) => tasks.find(t => t.id === id);

const create = (title) => {
  const task = {
    id: uuidv4(),
    title,
    status: 'pending',            // New tasks always start as pending
    createdAt: new Date().toISOString(),
  };
  tasks.push(task);
  return task;
};

// Update only the status field (completed | pending)
const updateStatus = (id, status) => {
  const task = tasks.find(t => t.id === id);
  if (!task) return null;
  task.status = status;
  return task;
};

// Delete all tasks with status === 'completed'
const deleteCompleted = () => {
  const before = tasks.length;
  tasks = tasks.filter(t => t.status !== 'completed');
  return before - tasks.length; // number of deleted tasks
};

// Delete a single task by id
const deleteById = (id) => {
  const index = tasks.findIndex(t => t.id === id);
  if (index === -1) return false;
  tasks.splice(index, 1);
  return true;
};

module.exports = { getAll, getById, create, updateStatus, deleteCompleted, deleteById };
