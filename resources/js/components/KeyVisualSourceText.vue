<template>
  <label for="keyVisualSource" class="form-label" v-if="!hasLabel">キービジュアル引用元</label>
  <input
    v-show="!toggleKeyVisualSource"
    type="text"
    class="form-control"
    id="keyVisualSource"
    placeholder="例）© SHUEISHA より引用"
  />
</template>

<script setup>
defineProps({
  toggleKeyVisualSource: {
    type: Boolean,
    default: false
  },
  hasLabel: {
    type: Boolean,
    default: false
  }
});
</script>