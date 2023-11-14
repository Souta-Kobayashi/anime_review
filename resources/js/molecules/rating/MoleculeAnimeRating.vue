<template>
  <div class="position-relative rating-item">
    <span class="rating-title">{{ ratingTitle }}：</span>
    <AtomRating :rating="ratingValue" size="35" />
  </div>
</template>

<script setup>
import AtomRating from '../../atoms/rating/AtomRating.vue';
const props = defineProps({
  ratingTitle: {
    type: String,
    default: '',
  },
  ratingValue: {
    type: String,
    default: '0',
  },
});
</script>
