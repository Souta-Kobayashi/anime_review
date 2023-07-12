<template>
  <label for="synopsis" class="form-label" v-if="!hasLabel">物語のあらすじ</label>
  <textarea
    v-show="!toggleSynopsis"
    class="form-control"
    id="synopsis"
    rows="5"
  ></textarea>
</template>

<script setup>
defineProps({
  toggleSynopsis: {
    type: Boolean,
    default: false
  },
  hasLabel: {
    type: Boolean,
    default: false
  }
});
</script>