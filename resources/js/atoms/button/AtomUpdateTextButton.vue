<template>
  <v-btn
    :disabled="!isPassed"
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
});
</script>
