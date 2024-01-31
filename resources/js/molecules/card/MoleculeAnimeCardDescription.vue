<template>
  <div class="anime-description-wrapper">
    <div>
      <h5 class="anime-title">{{ animeName }}</h5>
      <p class="category">
        カテゴリ：{{ formattedCategories }}
      </p>
      <AtomRating
        :rating="rating"
        :color="ratingColor"
        readonly
      />
    </div>
    <p class="synopsis">
      {{ synopsis }}
    </p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AtomRating from '../../atoms/rating/AtomRating.vue';
const props = defineProps({
  animeName: {
    type: String,
    default: '',
  },
  categories: {
    type: Array,
    default: [],
  },
  rating: {
    type: Number,
    default: null,
  },
  synopsis: {
    type: String,
    default: '',
  },
});

// レビュー4.0以上は色を変える
const ratingColor = computed(() =>
  props.rating >= 4.0 ? 'red-lighten-2' : 'amber'
);
const formattedCategories = ref(
  formatCategories(props.categories)
);

// カテゴリの配列をカンマ区切りの文字列に変換する
function formatCategories(categories) {
  return categories.join(', ');
}
</script>
