<script setup>
import BaseHeader from "./components/BaseHeader.vue";
import BaseFooter from "./components/BaseFooter.vue";
import { RouterLink, RouterView, useRouter, useRoute } from "vue-router";
</script>

<template>
  <base-header />
  <router-view></router-view>
  <base-footer />
</template>