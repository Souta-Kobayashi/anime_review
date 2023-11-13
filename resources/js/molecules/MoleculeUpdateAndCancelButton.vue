<template>
  <div class="d-flex justify-content-center">
    <AtomUpdateTextButton
      class="fw-bold me-2"
      color="indigo-darken-1"
      variant="flat"
      isPassed
      @click="$emit('updateAnimeInfo')"
    />
    <AtomCancelTextButton
      color="grey-darken-1"
      @click="$emit('closeEditor')"
    />
  </div>
</template>

<script setup>
import AtomCancelTextButton from '../atoms/button/AtomCancelTextButton.vue';
import AtomUpdateTextButton from '../atoms/button/AtomUpdateTextButton.vue';

const emit = defineEmits([
  'updateAnimeInfo',
  'closeEditor',
]);
</script>
