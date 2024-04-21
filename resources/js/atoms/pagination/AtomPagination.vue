<template>
  <v-pagination
    class="mt-4"
    :length="paginationLength"
    density="compact"
    rounded="circle"
    size="25"
    total-visible="5"
    @update:model-value="e => $emit('pageChange', e)"
  ></v-pagination>
</template>

<script setup>
defineProps({
  paginationLength: {
    type: Number,
    default: 1,
  },
});
defineEmits(["pageChange"]);
</script>
