<template>
  <v-rating
    v-model="ratingLocal"
    :size="size"
    :readonly="readonly"
    :color="color"
    density="compact"
    half-increments
  ></v-rating>
</template>

<script setup>
import { computed } from "vue";
const props = defineProps({
  rating: {
    type: Number,
    default: null,
  },
  size: {
    type: String,
    default: "25",
  },
  readonly: {
    type: Boolean,
    default: true,
  },
  color: {
    type: String,
    default: "amber",
  },
});
const emit = defineEmits(["update:rating"]);

const ratingLocal = computed({
  get() {
    return props.rating;
  },
  set(v) {
    emit("update:rating", v);
  },
});
</script>
