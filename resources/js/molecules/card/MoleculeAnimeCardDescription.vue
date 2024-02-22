<template>
  <div class="anime-description-wrapper">
    <div>
      <h5 class="anime-title">{{ animeName }}</h5>
      <div class="mb-1">
        <v-chip
          v-for="(category, index) in categories"
          :key="index"
          variant="tonal"
          class="me-1"
          size="x-small"
          >{{ category }}
        </v-chip>
      </div>
      <div>
        <AtomRating
          :rating="rating"
          :color="ratingColor"
          readonly
        />
      </div>
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
</script>
