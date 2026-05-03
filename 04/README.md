# Form Processing & Session Management

A simple web application demonstrating form processing, validation, cookies, and session management.

## Features

✅ **HTML Form** - Name, Email, Password fields  
✅ **Email Validation** - Regex validation for email format  
✅ **Form Processing** - GET and POST method simulation  
✅ **Cookies** - Store username for 7 days (Remember Me)  
✅ **Sessions** - Session-based login with sessionStorage  
✅ **Dashboard** - User info, cookies, and session display  
✅ **Logout** - Clear all session and cookie data  

## How to Use

1. **Open:** Double-click `index.html` or use local server
2. **Sign Up:** Create account with valid email & 6+ char password
3. **Login:** Login with registered credentials
4. **Dashboard:** View session and cookie info
5. **View Methods:** Click "View Form Data" to see GET/POST examples
6. **Logout:** Clear session and cookies

## What's Implemented

### 1. HTML Form
- Name, Email, Password input fields
- Signup & Login forms
- Remember Me checkbox

### 2. Form Processing
- **GET Method:** URL parameters (simulated)
- **POST Method:** Form body data (simulated)
- View both methods on dashboard

### 3. Email Validation
- Regex: `/^[^\s@]+@[^\s@]+\.[^\s@]+$/`
- Shows error if invalid format

### 4. Cookies
- Stores username when "Remember Me" checked
- Expires in 7 days
- Deleted on logout

### 5. Session Management
- Uses sessionStorage (temp storage)
- Session ID generated on login
- Login time recorded
- Cleared on tab close or logout

## Files

- `index.html` - Forms and dashboard UI
- `styles.css` - Responsive styling
- `script.js` - Validation, cookies, sessions

## Test Users

After signup, all users stored in localStorage. Try:
- **Name:** John Doe
- **Email:** john@example.com
- **Password:** 123456

## Browser Console

Open DevTools (F12) to see:
- GET/POST data logged
- Cookie operations
- Session information

Done! 🎉
