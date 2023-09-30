<template>
  <div class="mb-3">
    <label class="form-label">ジャンル</label>
    <FormToggleSetLater
      input-id="genreLateToggle"
      v-model="toggleGenreLocal"
    />
    <GenreSelectButton
      :toggle-genre="toggleGenreLocal"
      has-label
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import FormToggleSetLater from './FormToggleSetLater.vue';
import GenreSelectButton from './GenreSelectButton.vue';

const props = defineProps({
  toggleGenre: {
    type: Boolean,
    default: false
  }
});

const toggleGenreLocal = ref(prop.toggleGenre);
</script>