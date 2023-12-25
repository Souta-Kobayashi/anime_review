<template>
  <v-text-field
    label="キービジュアル引用元"
    placeholder="例）© SHUEISHA より引用"
    variant="underlined"
    @update:modelValue="
      e => $emit('update:keyVisualReference', e)
    "
  ></v-text-field>
</template>

<script setup>
const emit = defineEmits(['update:keyVisualReference']);
</script>
