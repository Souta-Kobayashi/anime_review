export function useHelpers() {
  const helpers = {
    sliceArray: (array, max) => {
      if (array.length > max) {
        array = array.slice(0, max);
      }
      return array;
    },
    toCamelCase: str => {
      return str.replace(/[-_]\w/g, match =>
        match.charAt(1).toUpperCase()
      );
    },
  };

  return helpers;
}
