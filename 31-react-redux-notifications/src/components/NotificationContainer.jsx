// NotificationContainer.jsx — Reads notifications from Redux and renders them

import React from 'react';
import { useSelector } from 'react-redux';
import NotificationToast from './NotificationToast';

const NotificationContainer = () => {
  // useSelector reads the notifications array from Redux store
  const notifications = useSelector(state => state.notifications);

  return (
    <div className="notification-container">
      {notifications.map(notification => (
        <NotificationToast key={notification.id} notification={notification} />
      ))}
    </div>
  );
};

export default NotificationContainer;
