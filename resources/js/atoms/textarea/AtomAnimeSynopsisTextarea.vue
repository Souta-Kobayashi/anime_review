<template>
  <v-textarea
    auto-grow
    label="物語のあらすじ"
    variant="outlined"
    @update:modelValue="e => $emit('update:synopsis', e)"
  ></v-textarea>
</template>

<script setup>
const props = defineProps({
  synopsis: {
    type: String,
    default: '',
  },
});
const emit = defineEmits(['update:synopsis']);
</script>
