<template>
  <div class="logout-btn-wrapper" @click="$emit('userLogout')">
    <span><v-icon color="white" icon="mdi-logout" /></span>
    <span class="logout-text">ログアウト</span>
  </div>
</template>

<script setup>
const emit = defineEmits(['userLogout']);
</script>
