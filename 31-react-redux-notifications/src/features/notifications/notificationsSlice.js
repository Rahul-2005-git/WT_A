// notificationsSlice.js — Redux Toolkit slice for managing notifications

import { createSlice } from '@reduxjs/toolkit';

// State is a simple array of notification objects
const notificationsSlice = createSlice({
  name: 'notifications',
  initialState: [],

  reducers: {
    // Action 1: Add a new notification to the list
    addNotification: (state, action) => {
      state.push({
        id: Date.now(),                         // Unique ID using timestamp
        message: action.payload.message,
        type: action.payload.type || 'info',    // Default type: info
      });
    },

    // Action 2: Remove notification by its id
    removeNotification: (state, action) => {
      return state.filter(n => n.id !== action.payload);
    },
  },
});

// Export actions so components can dispatch them
export const { addNotification, removeNotification } = notificationsSlice.actions;

// Export reducer to be registered in the store
export default notificationsSlice.reducer;
