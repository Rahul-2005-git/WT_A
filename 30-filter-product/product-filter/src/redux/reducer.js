import { SET_CATEGORY, SET_PRICE, RESET_FILTER } from "./actions";

const initialState = {
  products: [
    { id: 1, name: "Laptop", category: "Electronics", price: 50000 },
    { id: 2, name: "Phone", category: "Electronics", price: 20000 },
    { id: 3, name: "Shoes", category: "Fashion", price: 3000 },
    { id: 4, name: "T-Shirt", category: "Fashion", price: 1000 },
  ],
  category: "All",
  maxPrice: Infinity,
};

function reducer(state = initialState, action) {
  switch (action.type) {
    case SET_CATEGORY:
      return { ...state, category: action.payload };

    case SET_PRICE:
      return { ...state, maxPrice: action.payload };

    case RESET_FILTER:
      return { ...state, category: "All", maxPrice: Infinity };

    default:
      return state;
  }
}

export default reducer;