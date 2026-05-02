// App.jsx — Main application with buttons to trigger different notifications

import React from 'react';
import { useDispatch } from 'react-redux';
import { addNotification } from './features/notifications/notificationsSlice';
import NotificationContainer from './components/NotificationContainer';
import './App.css';

const App = () => {
  const dispatch = useDispatch();

  // Helper to dispatch a notification of given type and message
  const notify = (message, type) => {
    dispatch(addNotification({ message, type }));
  };

  return (
    <div className="app">
      <header className="app__header">
        <h1>🔔 Redux Notification System</h1>
        <p>Click buttons to trigger different notifications</p>
      </header>

      <main className="app__main">
        <div className="button-grid">
          <button className="btn btn--success" onClick={() => notify('✅ Operation completed successfully!', 'success')}>
            Success
          </button>
          <button className="btn btn--error" onClick={() => notify('❌ Something went wrong. Please try again.', 'error')}>
            Error
          </button>
          <button className="btn btn--warning" onClick={() => notify('⚠️ Warning: This action cannot be undone.', 'warning')}>
            Warning
          </button>
          <button className="btn btn--info" onClick={() => notify('ℹ️ New update available. Refresh to apply.', 'info')}>
            Info
          </button>
        </div>
      </main>

      {/* Notification toasts rendered here */}
      <NotificationContainer />
    </div>
  );
};

export default App;
