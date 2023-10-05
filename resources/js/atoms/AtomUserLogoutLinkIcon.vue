<template>
  <div class="sp-logout-btn-wrapper" @click="$emit('userLogout')">
    <span><v-icon color="white" icon="mdi-logout" /></span>
  </div>
</template>

<script setup>
const emit = defineEmits(['userLogout']);
</script>
