<template>
  <v-btn
    :disabled="!isPassed"
    :loading="loading"
    color="blue-darken-1"
    variant="text"
    >保存
  </v-btn>
</template>

<script setup>
const props = defineProps({
  isPassed: {
    type: Boolean,
    default: false,
  },
  loading: {
    type: Boolean,
    default: false,
  },
});
</script>
