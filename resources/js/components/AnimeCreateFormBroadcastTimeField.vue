<template>
  <div class="mb-3">
    <label class="form-label">放送時期</label>
    <FormToggleSetLater
      input-id="broadcastLateToggle"
      v-model="toggleBroadcastTimeLocal"
    />
    <BroadcastTimeSelectField
      :toggle-broadcast-time="toggleBroadcastTimeLocal"
      has-label
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import FormToggleSetLater from './FormToggleSetLater.vue';
import BroadcastTimeSelectField from './BroadcastTimeSelectField.vue';

const prop = defineProps({
  toggleBroadcastTime: {
    type: Boolean,
    default: false
  }
});

const toggleBroadcastTimeLocal = ref(prop.toggleBroadcastTime);
</script>