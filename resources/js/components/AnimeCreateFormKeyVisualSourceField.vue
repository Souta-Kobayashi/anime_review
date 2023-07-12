<template>
  <div class="mb-3">
    <label for="keyVisualSource" class="form-label">キービジュアル引用元</label>
    <FormToggleSetLater
      input-id="keyVisualSourceLateToggle"
      v-model="toggleKeyVisualSourceLocal"
    />
    <KeyVisualSourceText
      :toggle-key-visual-source="toggleKeyVisualSourceLocal"
      has-label
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import FormToggleSetLater from './FormToggleSetLater.vue';
import KeyVisualSourceText from './KeyVisualSourceText.vue';

const prop = defineProps({
  toggleKeyVisualSource: {
    type: Boolean,
    default: false
  }
});

const toggleKeyVisualSourceLocal = ref(prop.toggleKeyVisualSource);
</script>