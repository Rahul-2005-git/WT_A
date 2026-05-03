import { useState } from 'react';
import FeedbackForm from './components/FeedbackForm';
import FeedbackList from './components/FeedbackList';
import './App.css';

function App() {
  const [feedbacks, setFeedbacks] = useState([]);

  const addFeedback = (feedback) => {
    const newFeedback = {
      id: Date.now(),
      ...feedback,
      date: new Date().toLocaleDateString()
    };
    setFeedbacks([newFeedback, ...feedbacks]);
  };

  const deleteFeedback = (id) => {
    setFeedbacks(feedbacks.filter(feedback => feedback.id !== id));
  };

  return (
    <div className="app-container">
      <header className="header">
        <h1>Student Feedback Form</h1>
        <p className="subtitle">Share your feedback about the course or session</p>
      </header>

      <main className="main-content">
        <div className="form-section">
          <FeedbackForm onSubmit={addFeedback} />
        </div>

        <div className="feedback-section">
          <FeedbackList
            feedbacks={feedbacks}
            onDelete={deleteFeedback}
          />
        </div>
      </main>

      <footer className="footer">
        <p>&copy; 2024 Student Feedback System. All rights reserved.</p>
      </footer>
    </div>
  );
}

export default App;
