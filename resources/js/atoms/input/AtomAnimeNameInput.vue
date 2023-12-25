<template>
  <v-text-field
    label="アニメ名"
    placeholder="例）呪術廻戦"
    variant="underlined"
    @update:modelValue="e => $emit('update:animeName', e)"
  ></v-text-field>
</template>

<script setup>
const props = defineProps({
  animeName: {
    type: String,
    default: '',
  },
  serverErrorMessage: {
    type: Object,
    default: {},
  },
});
const emit = defineEmits(['update:animeName']);
</script>
