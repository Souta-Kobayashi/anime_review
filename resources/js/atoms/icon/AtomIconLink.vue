<template>
  <a :href="href" target="_blank">
    <v-icon
      color="white"
      :icon="mdiIcon"
      size="large"
    ></v-icon>
  </a>
</template>

<script setup>
defineProps({
  href: {
    type: String,
    default: "#",
  },
  mdiIcon: {
    type: String,
    default: "",
  },
});
</script>
