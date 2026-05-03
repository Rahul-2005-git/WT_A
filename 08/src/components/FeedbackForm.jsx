import { useState, useRef } from 'react';
import './FeedbackForm.css';

function FeedbackForm({ onSubmit }) {
  // Controlled component state
  const [formData, setFormData] = useState({
    studentName: '',
    courseName: '',
    rating: '5',
    feedback: ''
  });

  // Validation errors state
  const [errors, setErrors] = useState({});

  // useRef to access DOM elements
  const nameInputRef = useRef(null);
  const courseInputRef = useRef(null);
  const feedbackTextareaRef = useRef(null);
  const formRef = useRef(null);

  // Handle input changes (controlled components)
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
    // Clear error when user starts typing
    if (errors[name]) {
      setErrors(prev => ({
        ...prev,
        [name]: ''
      }));
    }
  };

  // Form validation
  const validateForm = () => {
    const newErrors = {};

    if (!formData.studentName.trim()) {
      newErrors.studentName = 'Student name is required';
    } else if (formData.studentName.trim().length < 3) {
      newErrors.studentName = 'Name must be at least 3 characters long';
    }

    if (!formData.courseName.trim()) {
      newErrors.courseName = 'Course name is required';
    } else if (formData.courseName.trim().length < 3) {
      newErrors.courseName = 'Course name must be at least 3 characters long';
    }

    if (!formData.feedback.trim()) {
      newErrors.feedback = 'Feedback is required';
    } else if (formData.feedback.trim().length < 10) {
      newErrors.feedback = 'Feedback must be at least 10 characters long';
    }

    return newErrors;
  };

  // Handle form submission
  const handleSubmit = (e) => {
    e.preventDefault();

    // Validate form
    const newErrors = validateForm();
    setErrors(newErrors);

    // If there are errors, focus on first error field using useRef
    if (Object.keys(newErrors).length > 0) {
      if (newErrors.studentName) {
        nameInputRef.current?.focus();
      } else if (newErrors.courseName) {
        courseInputRef.current?.focus();
      } else if (newErrors.feedback) {
        feedbackTextareaRef.current?.focus();
      }
      return;
    }

    // Submit form data if valid
    onSubmit(formData);

    // Reset form using useRef
    formRef.current?.reset();
    setFormData({
      studentName: '',
      courseName: '',
      rating: '5',
      feedback: ''
    });

    // Show success message
    alert('Feedback submitted successfully!');

    // Focus back on first input
    nameInputRef.current?.focus();
  };

  return (
    <div className="feedback-form-container">
      <h2>Submit Your Feedback</h2>
      
      <form ref={formRef} onSubmit={handleSubmit} className="feedback-form">
        {/* Student Name Field */}
        <div className="form-group">
          <label htmlFor="studentName">Student Name *</label>
          <input
            ref={nameInputRef}
            type="text"
            id="studentName"
            name="studentName"
            value={formData.studentName}
            onChange={handleInputChange}
            placeholder="Enter your full name"
            className={errors.studentName ? 'input-error' : ''}
          />
          {errors.studentName && (
            <span className="error-message">{errors.studentName}</span>
          )}
        </div>

        {/* Course Name Field */}
        <div className="form-group">
          <label htmlFor="courseName">Course Name *</label>
          <input
            ref={courseInputRef}
            type="text"
            id="courseName"
            name="courseName"
            value={formData.courseName}
            onChange={handleInputChange}
            placeholder="Enter course name"
            className={errors.courseName ? 'input-error' : ''}
          />
          {errors.courseName && (
            <span className="error-message">{errors.courseName}</span>
          )}
        </div>

        {/* Rating Field */}
        <div className="form-group">
          <label htmlFor="rating">Rating (1-10) *</label>
          <select
            id="rating"
            name="rating"
            value={formData.rating}
            onChange={handleInputChange}
            className="select-rating"
          >
            <option value="1">1 - Poor</option>
            <option value="2">2 - Fair</option>
            <option value="3">3 - Below Average</option>
            <option value="4">4 - Average</option>
            <option value="5">5 - Good</option>
            <option value="6">6 - Very Good</option>
            <option value="7">7 - Excellent</option>
            <option value="8">8 - Outstanding</option>
            <option value="9">9 - Excellent</option>
            <option value="10">10 - Perfect</option>
          </select>
        </div>

        {/* Feedback Field */}
        <div className="form-group">
          <label htmlFor="feedback">Your Feedback *</label>
          <textarea
            ref={feedbackTextareaRef}
            id="feedback"
            name="feedback"
            value={formData.feedback}
            onChange={handleInputChange}
            placeholder="Share your thoughts, suggestions, or comments about the course..."
            rows="5"
            className={errors.feedback ? 'input-error' : ''}
          />
          <span className="char-count">
            {formData.feedback.length} / 500 characters
          </span>
          {errors.feedback && (
            <span className="error-message">{errors.feedback}</span>
          )}
        </div>

        {/* Submit Button */}
        <button type="submit" className="submit-btn">
          Submit Feedback
        </button>
      </form>
    </div>
  );
}

export default FeedbackForm;
