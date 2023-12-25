<template>
  <v-file-input
    clearable
    label="キービジュアル画像"
    variant="underlined"
    @update:modelValue="
      e => $emit('update:keyVisualImage', e)
    "
  ></v-file-input>
</template>

<script setup>
const emit = defineEmits(['update:keyVisualImage']);
</script>
