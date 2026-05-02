import React, { useState, useEffect } from "react";

function App() {

  // ✅ Store current time
  const [time, setTime] = useState(new Date());

  // ✅ Start/Stop state
  const [running, setRunning] = useState(true);

  // ✅ Update every second
  useEffect(() => {
    if (running) {
      const interval = setInterval(() => {
        setTime(new Date());
      }, 1000);

      return () => clearInterval(interval);
    }
  }, [running]);

  // ✅ Format HH:MM:SS
  const formatTime = (date) => {
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();

    // Add leading zeros
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    return `${hours}:${minutes}:${seconds}`;
  };

  // Toggle Start/Stop
  const toggleClock = () => {
    setRunning(!running);
  };

  const styles = {
    height: "100vh",
    display: "flex",
    flexDirection: "column",
    justifyContent: "center",
    alignItems: "center",
    fontFamily: "Arial",
    background: "#111",
    color: "#00ffcc"
  };

  return (
    <div style={styles}>
      <h1>⏰ Digital Clock</h1>

      <h2 style={{ fontSize: "3rem", letterSpacing: "2px" }}>
        {formatTime(time)}
      </h2>

      <button
        onClick={toggleClock}
        style={{
          padding: "10px 20px",
          marginTop: "20px",
          cursor: "pointer"
        }}
      >
        {running ? "Stop" : "Start"}
      </button>
    </div>
  );
}

export default App;