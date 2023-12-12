<template>
  <div class="anime-description-wrapper">
    <div>
      <h5 class="anime-title">{{ animeName }}</h5>
      <p class="category">
        カテゴリ：{{ formattedCategories }}
      </p>
      <AtomRating :rating="rating" readonly />
    </div>
    <p class="synopsis">
      {{ synopsis }}
    </p>
  </div>
</template>

<script setup>
import { ref } from 'vue';
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

const formattedCategories = ref(
  formatCategories(props.categories)
);

// カテゴリの配列をカンマ区切りの文字列に変換する
function formatCategories(categories) {
  return categories.join(', ');
}
</script>
