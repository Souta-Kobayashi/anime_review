<template>
  <v-pagination
    v-model="currentPage"
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
import { ref } from 'vue';
const props = defineProps({
  paginationLength: {
    type: Number,
    default: 1,
  },
});
const emit = defineEmits(['pageChange']);

const currentPage = ref(1);
</script>
