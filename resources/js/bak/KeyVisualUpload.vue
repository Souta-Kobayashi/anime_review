<template>
  <label for="keyVisual" class="form-label" v-if="!hasLabel">キービジュアル</label>
  <input
    v-show="!toggleKeyVisual"
    type="file"
    class="form-control-file display-block"
    id="keyVisual"
  />
</template>

<script setup>
defineProps({
  toggleKeyVisual: {
    type: Boolean,
    default: false
  },
  hasLabel: {
    type: Boolean,
    default: false
  }
});
</script>