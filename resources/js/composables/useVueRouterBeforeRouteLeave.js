import { ref } from "vue";
import { useRouter, onBeforeRouteLeave } from "vue-router";

export function useVueRouterBeforeRouteLeave() {
  const isNavigationBlocked = ref(false);
  const nextPageURL = ref(false);
  const showConfirmationDialog = ref(false);
  const router = useRouter();

  /**
   * @param {boolean} v - ページ遷移可能かを表すブール値
   */
  const setNavigationBlocked = v => {
    isNavigationBlocked.value = v;
  };

  const goNextPage = () => {
    setNavigationBlocked(false);
    router.push(nextPageURL.value);
  };

  const hideNavigationConfirmDialog = () => {
    showConfirmationDialog.value = false;
  };

  /**
   * フォームが変更されている場合に確認ダイアログを表示
   */
  onBeforeRouteLeave(to => {
    // フォーム編集中は画面遷移させずダイアログ表示
    if (isNavigationBlocked.value) {
      showConfirmationDialog.value = true;
      nextPageURL.value = to.fullPath;
      return false;
    }
  });

  return {
    setNavigationBlocked,
    goNextPage,
    hideNavigationConfirmDialog,
    showConfirmationDialog,
  };
}
