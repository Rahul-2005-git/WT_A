import React from "react";
import { Provider } from "react-redux";
import store from "./store";
import Filter from "./components/Filter";
import ProductList from "./components/ProductList";

function App() {
  return (
    <Provider store={store}>
      <div style={{ textAlign: "center" }}>
        <h2>🛍 Product Filter App</h2>
        <Filter />
        <ProductList />
      </div>
    </Provider>
  );
}

export default App;