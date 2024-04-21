<template>
  <div class="text-center more-button">
    <v-btn
      class="text-white rounded-pill"
      :to="{ name: 'anime' }"
      :ripple="false"
      color="rgba(27, 37, 56, 1)"
      variant="flat"
      size="large"
      width="200"
      :loading="isLoading"
      @click="isLoading = true"
    >
      もっと見る
    </v-btn>
  </div>
</template>

<script setup>
import { ref } from "vue";
const isLoading = ref(false);
</script>
