<template>
  <span class="rating-comprehensive-title me-2"
    >総合評価：</span
  >
  <span
    class="rating-avg"
    :class="{ 'highly-rated': isHighlyRated }"
    >{{ reviewAverage }}</span
  >
</template>

<script setup>
import { computed } from 'vue';
const props = defineProps({
  reviewAverage: {
    type: String,
    default: 'ー',
  },
});

// 評価が4.0以上は色付きで表示する
const isHighlyRated = computed(() =>
  props.reviewAverage >= 4.0 ? true : false
);
</script>
