import React, { useState, useEffect } from "react";

function App() {

  // ✅ Load theme from localStorage or default to light
  const [theme, setTheme] = useState(() => {
    return localStorage.getItem("theme") || "light";
  });

  // ✅ Save theme whenever it changes
  useEffect(() => {
    localStorage.setItem("theme", theme);
  }, [theme]);

  // Toggle function
  const toggleTheme = () => {
    setTheme(theme === "light" ? "dark" : "light");
  };

  // Styles
  const styles = {
    backgroundColor: theme === "light" ? "#ffffff" : "#121212",
    color: theme === "light" ? "#000000" : "#ffffff",
    height: "100vh",
    display: "flex",
    flexDirection: "column",
    justifyContent: "center",
    alignItems: "center",
    transition: "0.3s"
  };

  return (
    <div style={styles}>
      <h1>{theme === "light" ? "🌞 Light Mode" : "🌙 Dark Mode"}</h1>

      <button
        onClick={toggleTheme}
        style={{
          padding: "10px 20px",
          marginTop: "20px",
          cursor: "pointer"
        }}
      >
        Toggle Theme
      </button>
    </div>
  );
}

export default App;