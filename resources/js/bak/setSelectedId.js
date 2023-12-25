import { ref } from 'vue'

export function useSetSelectedId() {
  const selectedSeasonButton = ref(null);
  const selectedGenreButton = ref(null);

  // 放送時期, ジャンルのボタン選択時のactiveクラスを付与するための処理
  const setTargetId = (e) => {
    const targetButton =
      e.currentTarget.id === 'broadcastSeason'
        ? selectedSeasonButton
        : selectedGenreButton;
    if (targetButton.value === e.target.id) return;
    targetButton.value = e.target.id;
  };

  return {
    selectedSeasonButton,
    selectedGenreButton,
    setTargetId,
  };
}