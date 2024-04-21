<template>
  <v-textarea
    auto-grow
    label="物語のあらすじ"
    variant="outlined"
    @update:model-value="e => $emit('update:synopsis', e)"
  ></v-textarea>
</template>

<script setup>
defineProps({
  synopsis: {
    type: String,
    default: "",
  },
});
defineEmits(["update:synopsis"]);
</script>
