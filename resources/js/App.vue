<script setup>
import { RouterView } from "vue-router";
import AtomToast from "./atoms/notify/AtomToast.vue";
</script>

<template>
  <v-app>
    <router-view></router-view>
    <AtomToast />
  </v-app>
</template>
