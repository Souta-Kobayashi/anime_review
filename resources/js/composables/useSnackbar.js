import { ref, computed } from "vue";

/*
* NOTE: コンポーネント間での状態保持のためexport外で変数、メソッドを定義する
* export内で宣言すると別コンポーネントでimportする度インスタンスが生成され値がリセットされる。
*/

const snackbarMessage = ref('');
const snackbarColor = ref('');
const shouldShowSnackbar = ref(false);
const snackbarTimeout = 3000;

// setter
const setSnackbarMessage = (message) => {
  snackbarMessage.value = message;
};
const setSnackbarColor = (color) => {
  snackbarColor.value = color;
};
const setShouldShowSnackbar = (isShow) => {
  shouldShowSnackbar.value = isShow;
}
const setSnackbar = (message, color, isShow = true) => {
  setSnackbarMessage(message);
  setSnackbarColor(color);
  setShouldShowSnackbar(isShow);
};

// getter
const getter = {
  snackbarMessage: computed(() => snackbarMessage.value),
  snackbarColor: computed(() => snackbarColor.value),
  snackbarTimeout: snackbarTimeout,
  shouldShowSnackbar: shouldShowSnackbar,
};

export function useSnackbar() {
  return {
    ...getter,
    setSnackbar,
  };
}