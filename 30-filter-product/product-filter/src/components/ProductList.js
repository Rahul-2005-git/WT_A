import React from "react";
import { useSelector } from "react-redux";

function ProductList() {
  const { products, category, maxPrice } = useSelector(state => state);

  const filteredProducts = products.filter(p => {
    return (
      (category === "All" || p.category === category) &&
      p.price <= maxPrice
    );
  });

  return (
    <div>
      <h3>Products</h3>

      {filteredProducts.map(p => (
        <div key={p.id}>
          {p.name} - {p.category} - ₹{p.price}
        </div>
      ))}
    </div>
  );
}

export default ProductList;