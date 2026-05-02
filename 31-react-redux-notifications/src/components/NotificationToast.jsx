// NotificationToast.jsx — Renders a single dismissible toast notification

import React, { useEffect } from 'react';
import { useDispatch } from 'react-redux';
import { removeNotification } from '../features/notifications/notificationsSlice';

const NotificationToast = ({ notification }) => {
  const dispatch = useDispatch();

  // Auto-dismiss the notification after 4000ms
  useEffect(() => {
    const timer = setTimeout(() => {
      dispatch(removeNotification(notification.id));
    }, 4000);
    return () => clearTimeout(timer); // cleanup if component unmounts early
  }, [dispatch, notification.id]);

  // Manual dismiss on close button click
  const handleDismiss = () => {
    dispatch(removeNotification(notification.id));
  };

  return (
    <div className={`toast toast--${notification.type}`}>
      <span className="toast__message">{notification.message}</span>
      <button className="toast__close" onClick={handleDismiss} title="Dismiss">
        &times;
      </button>
    </div>
  );
};

export default NotificationToast;
