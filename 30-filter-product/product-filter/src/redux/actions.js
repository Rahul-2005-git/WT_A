export const SET_CATEGORY = "SET_CATEGORY";
export const SET_PRICE = "SET_PRICE";
export const RESET_FILTER = "RESET_FILTER";

export const setCategory = (category) => ({
  type: SET_CATEGORY,
  payload: category,
});

export const setPrice = (price) => ({
  type: SET_PRICE,
  payload: price,
});

export const resetFilter = () => ({
  type: RESET_FILTER,
});