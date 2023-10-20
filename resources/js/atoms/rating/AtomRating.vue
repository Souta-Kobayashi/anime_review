<template>
  <v-rating
    :size="size"
    :model-value="rating"
    color="amber"
    density="compact"
    half-increments
    readonly
  ></v-rating>
</template>

<script setup>
const props = defineProps({
  rating: {
    type: String,
    default: '',
  },
  size: {
    type: String,
    default: '25',
  },
  readonly: {
    type: Boolean,
    default: false,
  },
});
</script>
