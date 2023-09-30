<template>
  <div class="hamburger">
    <button type="button" @click="$emit('toggleHamburgerMenu')">
      <v-icon color="white" icon="mdi-menu" size="large" />
    </button>
  </div>
</template>

<script setup>
defineEmits(['toggleHamburgerMenu']);
</script>
