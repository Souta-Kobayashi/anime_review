export function useHelpers() {
  const helpers = {
    sliceArray: (array, max) => {
      if (array.length > max) {
        array = array.slice(0, max);
      }
      return array;
    },
  };

  return helpers;
}
