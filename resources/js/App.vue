<script setup>
import BaseHeader from "./components/BaseHeader.vue";
import { RouterLink, RouterView, useRouter, useRoute } from "vue-router";
</script>

<template>
  <base-header />
  <router-view></router-view>
</template>