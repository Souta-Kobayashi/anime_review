import vueScrollTo from 'vue-scrollto';

const options = {
  container: 'body',
  duration: 100,
  easing: 'ease',
  offset: 0,
  force: true,
  cancelable: true,
  onStart: false,
  onDone: false,
  onCancel: false,
  x: false,
  y: true,
};

export function useVueScrollTo() {
  return {
    vueScrollTo,
    options,
  };
}
