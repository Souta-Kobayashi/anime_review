<template>
  <span class="rating-comprehensive-title me-2"
    >総合評価：</span
  >
  <span
    class="rating-avg"
    :class="{ 'highly-rated': isHighlyRated }"
    >{{ reviewAverageView }}</span
  >
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
const props = defineProps({
  reviewAverage: {
    type: Number,
    default: 0,
  },
});

const reviewAverageView = ref(0);

onMounted(() => {
  startRatingAverageAnimation();
});

watch(
  () => props.reviewAverage,
  () => {
    startRatingAverageAnimation();
  }
);

const startRatingAverageAnimation = () => {
  // 固定の増分/減分値
  const increment = 0.1;
  const decrement = 0.1;
  // アニメーションの実行間隔
  const execAnimation = 25;

  const animate = () => {
    reviewAverageView.value =
      reviewAverageView.value === "ー"
        ? 0
        : reviewAverageView.value;

    if (reviewAverageView.value < props.reviewAverage) {
      reviewAverageView.value = (
        parseFloat(reviewAverageView.value) + increment
      ).toFixed(1);
    } else if (
      reviewAverageView.value > props.reviewAverage
    ) {
      reviewAverageView.value = (
        parseFloat(reviewAverageView.value) - decrement
      ).toFixed(1);
    } else {
      reviewAverageView.value =
        reviewAverageView.value !== 0
          ? props.reviewAverage.toFixed(1)
          : "ー";
      return;
    }

    setTimeout(animate, execAnimation);
  };
  animate();
};

// 評価が4.0以上は色付きで表示する
const isHighlyRated = computed(() =>
  reviewAverageView.value >= 4.0 ? true : false
);
</script>
