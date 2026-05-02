// store.js — Central Redux store using Redux Toolkit's configureStore

import { configureStore } from '@reduxjs/toolkit';
import notificationsReducer from '../features/notifications/notificationsSlice';

const store = configureStore({
  reducer: {
    notifications: notificationsReducer, // Key 'notifications' maps to state.notifications
  },
});

export default store;
