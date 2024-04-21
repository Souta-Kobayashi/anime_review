<template>
  <v-text-field
    label="アニメ名"
    placeholder="例）呪術廻戦"
    variant="underlined"
    @update:model-value="e => $emit('update:animeName', e)"
  ></v-text-field>
</template>

<script setup>
defineProps({
  animeName: {
    type: String,
    default: "",
  },
  serverErrorMessage: {
    type: Object,
    default: () => ({}),
  },
});
defineEmits(["update:animeName"]);
</script>
