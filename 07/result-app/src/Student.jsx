function Student({ student, handleChange }) {
  return (
    <div className="card">
      <h2>Student Info</h2>
      <p>Name: {student.name}</p>
      <p>Course: {student.course}</p>

      <h3>Enter Marks</h3>

      <input name="sub1_mse" placeholder="Sub1 MSE" onChange={handleChange} />
      <input name="sub1_ese" placeholder="Sub1 ESE" onChange={handleChange} />

      <input name="sub2_mse" placeholder="Sub2 MSE" onChange={handleChange} />
      <input name="sub2_ese" placeholder="Sub2 ESE" onChange={handleChange} />

      <input name="sub3_mse" placeholder="Sub3 MSE" onChange={handleChange} />
      <input name="sub3_ese" placeholder="Sub3 ESE" onChange={handleChange} />

      <input name="sub4_mse" placeholder="Sub4 MSE" onChange={handleChange} />
      <input name="sub4_ese" placeholder="Sub4 ESE" onChange={handleChange} />
    </div>
  );
}

export default Student;