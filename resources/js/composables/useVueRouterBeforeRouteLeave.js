import { ref } from 'vue';
import { onBeforeRouteLeave } from 'vue-router';

export function useVueRouterBeforeRouteLeave() {
  const isFormDirty = ref(false);

  /**
   * @param {boolean} v - フォームの変更状態を表すブール値
   */
  const setFormDirty = v => {
    isFormDirty.value = v;
  };

  /**
   * フォームが変更されている場合に確認ダイアログを表示
   */
  const pageLeaveNavigation = onBeforeRouteLeave(
    (to, from) => {
      if (isFormDirty.value && to.path !== from.path) {
        const answer = window.confirm(
          'このページから移動しても良いですか？データは保持されません。'
        );
        if (!answer) return false;
      }
    }
  );

  return {
    setFormDirty,
  };
}
