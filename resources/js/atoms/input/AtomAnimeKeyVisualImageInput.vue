<template>
  <v-file-input
    clearable
    label="キービジュアル画像"
    variant="underlined"
    @update:model-value="
      e => $emit('update:keyVisualImage', e)
    "
  ></v-file-input>
</template>

<script setup>
defineEmits(["update:keyVisualImage"]);
</script>
