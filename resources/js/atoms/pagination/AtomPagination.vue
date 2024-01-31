<template>
  <v-pagination
    class="mt-4"
    :length="paginationLength"
    density="compact"
    rounded="circle"
    size="25"
    total-visible="5"
    @update:modelValue="e => $emit('pageChange', e)"
  ></v-pagination>
</template>

<script setup>
const props = defineProps({
  paginationLength: {
    type: Number,
    default: 1,
  },
});
const emit = defineEmits(['pageChange']);
</script>
