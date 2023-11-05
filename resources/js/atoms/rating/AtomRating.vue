<template>
  <v-rating
    :size="size"
    v-model="ratingLocal"
    :readonly="readonly"
    color="amber"
    density="compact"
    half-increments
  ></v-rating>
</template>

<script setup>
import { computed } from 'vue';
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
    default: true,
  },
});
const emit = defineEmits(['update:rating']);

const ratingLocal = computed({
  get() {
    return props.rating;
  },
  set(v) {
    emit('update:rating', v);
  },
});
</script>
