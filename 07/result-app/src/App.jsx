import { useState } from "react";
import Student from "./Student";
import Result from "./Result";
import "./App.css";

function App() {
  const [marks, setMarks] = useState({
    sub1_mse: "",
    sub1_ese: "",
    sub2_mse: "",
    sub2_ese: "",
    sub3_mse: "",
    sub3_ese: "",
    sub4_mse: "",
    sub4_ese: ""
  });

  const student = {
    name: "Kunal",
    course: "B.Tech IT"
  };

  // Handle input change
  const handleChange = (e) => {
    setMarks({ ...marks, [e.target.name]: e.target.value });
  };

  // Save result to PHP + MySQL
  const saveResult = async () => {
    const calc = (mse, ese) => (mse * 0.3) + (ese * 0.7);

    const s1 = calc(marks.sub1_mse || 0, marks.sub1_ese || 0);
    const s2 = calc(marks.sub2_mse || 0, marks.sub2_ese || 0);
    const s3 = calc(marks.sub3_mse || 0, marks.sub3_ese || 0);
    const s4 = calc(marks.sub4_mse || 0, marks.sub4_ese || 0);

    const total = s1 + s2 + s3 + s4;
    const avg = total / 4;

    const status = avg >= 40 ? "PASS" : "FAIL";

    try {
      const response = await fetch("http://localhost/result/save.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          name: student.name,
          course: student.course,
          total: total,
          status: status
        })
      });

      const data = await response.text();
      alert("Saved Successfully!");
      console.log(data);

    } catch (error) {
      console.error("Error:", error);
      alert("Failed to save data");
    }
  };

  return (
    <div className="container">
      <h1>VIT Result System</h1>

      {/* Child Component */}
      <Student student={student} handleChange={handleChange} />

      {/* Child Component */}
      <Result marks={marks} />

      {/* Save Button */}
      <button onClick={saveResult}>Save Result</button>
    </div>
  );
}

export default App;