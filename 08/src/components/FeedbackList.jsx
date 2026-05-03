import './FeedbackList.css';

function FeedbackList({ feedbacks, onDelete }) {
  return (
    <div className="feedback-list-container">
      <h2>Submitted Feedbacks ({feedbacks.length})</h2>

      {feedbacks.length === 0 ? (
        <div className="no-feedback">
          <p>No feedbacks submitted yet. Be the first to share your thoughts!</p>
        </div>
      ) : (
        <div className="feedback-list">
          {/* Render feedbacks using map with key */}
          {feedbacks.map((feedback) => (
            <div key={feedback.id} className="feedback-card">
              <div className="feedback-header">
                <div className="feedback-title">
                  <h3>{feedback.studentName}</h3>
                  <span className="course-name">{feedback.courseName}</span>
                </div>
                <div className="feedback-meta">
                  <span className="rating-badge">
                    Rating: {feedback.rating}/10
                  </span>
                  <span className="feedback-date">{feedback.date}</span>
                </div>
              </div>

              <div className="feedback-content">
                <p>{feedback.feedback}</p>
              </div>

              <div className="feedback-footer">
                <button
                  onClick={() => onDelete(feedback.id)}
                  className="delete-btn"
                >
                  Delete
                </button>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default FeedbackList;
