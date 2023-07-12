<template>
  <div class="form-check form-switch mb-2">
    <input
      class="form-check-input"
      type="checkbox"
      :id="inputId"
      :checked="modelValue"
      @change="$emit('update:modelValue', $event.target.checked)"
    />
    <label class="form-check-label" :for="inputId">あとで設定する</label>
  </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
  modelValue: Boolean,
  inputId: String
});
defineEmits(['update:modelValue']);
</script>