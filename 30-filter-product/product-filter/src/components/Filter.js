import React from "react";
import { useDispatch } from "react-redux";
import { setCategory, setPrice, resetFilter } from "../redux/actions";

function Filter() {
  const dispatch = useDispatch();

  return (
    <div>
      <h3>Filter</h3>

      <select onChange={(e) => dispatch(setCategory(e.target.value))}>
        <option value="All">All</option>
        <option value="Electronics">Electronics</option>
        <option value="Fashion">Fashion</option>
      </select>

      <br /><br />

      <input
        type="number"
        placeholder="Max Price"
        onChange={(e) => dispatch(setPrice(Number(e.target.value)))}
      />

      <br /><br />

      <button onClick={() => dispatch(resetFilter())}>
        Reset Filters
      </button>
    </div>
  );
}

export default Filter;