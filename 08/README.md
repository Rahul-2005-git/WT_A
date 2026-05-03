# Student Feedback Form

A simple and responsive React application for collecting student feedback about courses and sessions. The application demonstrates form validation, controlled components, useRef hooks, and list rendering with keys.

## Features

✨ **Core Features:**
- **Feedback Form with Validation**: Client-side form validation with error messages
- **Controlled Components**: Uses `useState()` hook for form state management
- **useRef Hooks**: DOM element access for focus management and form reset
- **List Rendering**: Feedback list with keys for optimal rendering
- **Submit Feedback Display**: Real-time feedback display with timestamps
- **Delete Functionality**: Remove submitted feedbacks
- **Responsive Design**: Mobile-friendly, works on all devices
- **Rating System**: 1-10 rating scale for feedback

## Project Structure

```
08/
├── src/
│   ├── components/
│   │   ├── FeedbackForm.jsx       # Form component with validation & useRef
│   │   ├── FeedbackForm.css       # Form styling
│   │   ├── FeedbackList.jsx       # Display feedbacks with keys
│   │   └── FeedbackList.css       # List styling
│   ├── App.jsx                    # Parent component managing state
│   ├── App.css                    # Main application styling
│   ├── main.jsx                   # Entry point
│   ├── index.css                  # Global styles
│   └── assets/                    # Images and icons
├── index.html                     # Main HTML file
├── package.json                   # Project dependencies
├── vite.config.js                # Vite configuration
└── README.md                      # This file
```

## Prerequisites

- **Node.js** (v14 or higher)
- **npm** (comes with Node.js)

## Installation & Setup

### Step 1: Navigate to the project folder
```bash
cd "d:\Kunal Files\SEM 6\Web Technology\Lab_Exam\08"
```

### Step 2: Install dependencies (if not already installed)
```bash
npm install
```

### Step 3: Start the development server
```bash
npm run dev
```

### Step 4: Open in browser
The application will be available at:
```
http://localhost:5175/
```
(Or check the terminal for the correct port if different)

## How to Use

1. **Fill the Form**: Enter student name, course name, select a rating, and write feedback
2. **Validation**: The form validates all fields:
   - Student Name: Minimum 3 characters required
   - Course Name: Minimum 3 characters required
   - Feedback: Minimum 10 characters required
3. **See Errors**: If validation fails, error messages appear and focus is set on the first error field
4. **Submit**: Click "Submit Feedback" button to submit the form
5. **View Feedback**: Submitted feedbacks appear in the right panel with date, rating, and content
6. **Delete Feedback**: Click "Delete" button to remove a feedback

## Component Details

### App.jsx (Parent Component)
- Manages application state for feedbacks
- Handles adding new feedbacks with unique IDs and timestamps
- Passes callbacks to child components
- Manages feedback deletion

### FeedbackForm.jsx (Child Component)
- **Controlled Components**: Uses `useState()` for form inputs (name, course, rating, feedback)
- **useRef Hooks**: 
  - `nameInputRef` - Focus on name input
  - `courseInputRef` - Focus on course input
  - `feedbackTextareaRef` - Focus on feedback textarea
  - `formRef` - Form reset functionality
- **Form Validation**: 
  - Validates field lengths
  - Shows error messages
  - Focus on first error field using useRef
- **Dynamic Feedback**: Character count for textarea

### FeedbackList.jsx (Child Component)
- **List with Keys**: Uses `map()` with unique `feedback.id` as key
- Displays all submitted feedbacks
- Shows student name, course, rating, date, and feedback content
- Delete button with handler callback

## React Concepts Used

✅ **useState Hook**: Managing form state and feedbacks  
✅ **useRef Hook**: DOM element focus and form reset  
✅ **Controlled Components**: Form inputs with value and onChange  
✅ **Form Validation**: Client-side validation with error messages  
✅ **List Rendering**: Using `.map()` with unique keys  
✅ **Props**: Data passing and callback functions  
✅ **Event Handling**: Form submission and input changes  
✅ **Conditional Rendering**: Error messages and empty states  

## Validation Rules

| Field | Rules |
|-------|-------|
| Student Name | Minimum 3 characters, required |
| Course Name | Minimum 3 characters, required |
| Rating | 1-10 scale, auto-selected (default 5) |
| Feedback | Minimum 10 characters, required, max 500 |

## Available Scripts

| Command | Description |
|---------|------------|
| `npm run dev` | Start development server |
| `npm run build` | Create production build |
| `npm run preview` | Preview production build |

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Key Implementation Details

### Controlled Components with useState()
```javascript
const [formData, setFormData] = useState({
  studentName: '',
  courseName: '',
  rating: '5',
  feedback: ''
});
```

### useRef for DOM Access
```javascript
const nameInputRef = useRef(null);

// Focus on input
nameInputRef.current?.focus();

// Reset form
formRef.current?.reset();
```

### List Rendering with Keys
```javascript
{feedbacks.map((feedback) => (
  <div key={feedback.id} className="feedback-card">
    {/* Feedback content */}
  </div>
))}
```

## Features Demonstration

### Form Validation
- Try submitting with empty fields → See error messages
- Try entering short text → See validation errors
- Error messages appear below each field
- Focus automatically moves to first error field

### Controlled Components
- Type in any form field → State updates in real-time
- Character count updates as you type
- Form clears after successful submission

### useRef Usage
- Focus management with validation errors
- Form reset after submission
- Direct DOM element access

### List Keys
- Efficient re-rendering of feedbacks
- Proper key usage with unique `feedback.id`
- Maintains component state correctly

## Future Enhancements

- Backend API integration
- Database persistence
- User authentication
- Email notifications
- Analytics dashboard
- Feedback filtering and search
- Export feedback to PDF
- Multiple language support

## Notes

- The application uses sample data handling
- All feedbacks are stored in React state (not persisted)
- Page refresh will clear all feedbacks
- For production, integrate with a backend API

## License

This project is created for educational purposes.

---

**Happy Coding! 🚀**
