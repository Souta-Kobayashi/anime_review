<template>
  <v-text-field
    label="キービジュアル引用元"
    placeholder="例）© SHUEISHA より引用"
    variant="underlined"
    @update:model-value="
      e => $emit('update:keyVisualReference', e)
    "
  ></v-text-field>
</template>

<script setup>
defineEmits(["update:keyVisualReference"]);
</script>
