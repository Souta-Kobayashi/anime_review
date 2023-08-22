<template>
  <BaseHeader />
  <main>
    <h1>Top</h1>
    <router-link to="/anime">to anime</router-link>
  </main>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import Snackbar from "../components/Snackbar.vue";
</script>