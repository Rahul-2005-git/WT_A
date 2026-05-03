function Result({ marks }) {

  const calc = (mse, ese) => {
    return (mse * 0.3) + (ese * 0.7);
  };

  const s1 = calc(marks.sub1_mse || 0, marks.sub1_ese || 0);
  const s2 = calc(marks.sub2_mse || 0, marks.sub2_ese || 0);
  const s3 = calc(marks.sub3_mse || 0, marks.sub3_ese || 0);
  const s4 = calc(marks.sub4_mse || 0, marks.sub4_ese || 0);

  const total = s1 + s2 + s3 + s4;
  const avg = total / 4;

  const status = avg >= 40 ? "PASS" : "FAIL";

  return (
    <div className="card">
      <h2>Result</h2>
      <p>Total: {total.toFixed(2)}</p>
      <p>Average: {avg.toFixed(2)}</p>

      <h3 style={{ color: status === "PASS" ? "green" : "red" }}>
        Status: {status}
      </h3>
    </div>
  );
}

export default Result;