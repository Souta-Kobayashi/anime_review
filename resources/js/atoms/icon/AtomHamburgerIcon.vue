<template>
  <v-icon
    color="white"
    icon="mdi-menu"
    size="large"
    @click="$emit('toggleHamburgerMenu')"
  />
</template>

<script setup>
defineEmits(['toggleHamburgerMenu']);
</script>
