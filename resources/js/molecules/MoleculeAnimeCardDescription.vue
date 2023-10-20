<template>
  <div class="anime-description-wrapper">
    <div>
      <h5 class="anime-title">{{ animeName }}</h5>
      <p class="category">カテゴリ：{{ category }}</p>
      <AtomRating :rating="rating" readonly />
    </div>
    <p class="synopsis">
      {{ synopsis }}
    </p>
  </div>
</template>

<script setup>
import AtomRating from '../atoms/rating/AtomRating.vue';
const props = defineProps({
  animeName: {
    type: String,
    default: '',
  },
  category: {
    type: String,
    default: '',
  },
  rating: {
    type: String,
    default: '',
  },
  synopsis: {
    type: String,
    default: '',
  },
});
</script>
