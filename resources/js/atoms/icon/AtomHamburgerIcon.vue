<template>
  <v-icon
    color="white"
    icon="mdi-menu"
    size="large"
    @click="$emit('toggleHamburgerMenu')"
    aria-label="メニューを開く"
  />
</template>

<script setup>
defineEmits(['toggleHamburgerMenu']);
</script>
