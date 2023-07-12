<template>
  <div class="mb-3">
    <label for="keyVisual" class="form-label">キービジュアル</label>
    <FormToggleSetLater
      input-id="keyVisualLateToggle"
      v-model="toggleKeyVisualLocal"
    />
    <KeyVisualUpload
      :toggle-key-visual="toggleKeyVisualLocal"
      has-label
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import FormToggleSetLater from './FormToggleSetLater.vue';
import KeyVisualUpload from './KeyVisualUpload.vue';

const prop = defineProps({
  toggleKeyVisual: {
    type: Boolean,
    default: false
  }
});

const toggleKeyVisualLocal = ref(prop.toggleKeyVisual);
</script>