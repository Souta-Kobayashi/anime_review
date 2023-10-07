<template>
  <BaseHeader />
  <main>
    <h1>Top</h1>
    <RouterLink to="/anime">to anime</RouterLink>
  </main>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import Snackbar from "../components/Snackbar.vue";
</script>