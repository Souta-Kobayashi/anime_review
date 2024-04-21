<template>
  <v-btn
    :disabled="!isPassed"
    :loading="loading"
    block
    color="blue-accent-4"
    size="large"
    type="submit"
    variant="tonal"
    @click="$emit('submitCategoryRegister')"
  >
    カテゴリを登録する
  </v-btn>
</template>

<script setup>
defineProps({
  isPassed: {
    type: Boolean,
    default: false,
  },
  loading: {
    type: Boolean,
    default: false,
  },
});
defineEmits(["submitCategoryRegister"]);
</script>
