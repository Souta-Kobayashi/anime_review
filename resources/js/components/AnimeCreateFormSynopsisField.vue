<template>
  <div class="mb-3">
    <label for="synopsis" class="form-label">物語のあらすじ</label>
    <FormToggleSetLater
      input-id="synopsisLateToggle"
      v-model="toggleSynopsisLocal"
    />
    <SynopsisTextArea
      :toggle-synopsis="toggleSynopsisLocal"
      has-label
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import FormToggleSetLater from './FormToggleSetLater.vue';
import SynopsisTextArea from './SynopsisTextArea.vue';

const props = defineProps({
  toggleSynopsis: {
    type: Boolean,
    default: false
  }
});

const toggleSynopsisLocal = ref(prop.toggleSynopsis);
</script>