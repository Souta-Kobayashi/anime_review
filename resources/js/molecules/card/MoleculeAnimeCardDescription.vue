<template>
  <div class="anime-description-wrapper">
    <div class="anime-description">
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
import { computed, onMounted } from "vue";
import AtomRating from "../../atoms/rating/AtomRating.vue";
const props = defineProps({
  animeId: {
    type: Number,
    default: null,
  },
  animeName: {
    type: String,
    default: "",
  },
  categories: {
    type: Array,
    default: () => [],
  },
  rating: {
    type: Number,
    default: null,
  },
  synopsis: {
    type: String,
    default: "",
  },
});

// レビュー4.0以上は色を変える
const ratingColor = computed(() =>
  props.rating >= 4.0 ? "red-lighten-2" : "amber"
);

onMounted(() => {
  const synopsis = document.querySelector(
    `#anime-${props.animeId} .synopsis`
  );
  const animeDescription = document.querySelector(
    `#anime-${props.animeId} .anime-description`
  );
  const animeDescriptionHeight =
    animeDescription.offsetHeight;

  // あらすじ部のheight =
  //   カード全体のheight(350px) - 上下のpadding(20px) - あらすじ以外の要素のheight
  const newSynopsisHeight =
    350 - 20 - animeDescriptionHeight;
  synopsis.style.height = newSynopsisHeight + "px";

  // カテゴリのchip数に応じてあらすじ部のheightが変化するため、
  // -webkit-line-clampの値を出し分けている
  let lineClampValue;
  if (newSynopsisHeight <= 97) {
    lineClampValue = 5;
  } else if (newSynopsisHeight <= 121) {
    lineClampValue = 6;
  } else if (newSynopsisHeight <= 145) {
    lineClampValue = 7;
  } else if (newSynopsisHeight <= 169) {
    lineClampValue = 8;
  } else if (newSynopsisHeight <= 193) {
    lineClampValue = 9;
  } else if (newSynopsisHeight <= 217) {
    lineClampValue = 10;
  }
  synopsis.style.webkitLineClamp = lineClampValue;
});
</script>
