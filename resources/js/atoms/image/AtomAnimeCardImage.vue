<template>
  <v-img
    :src="src"
    height="350"
    alt="アニメのキービジュアル画像"
    cover
  >
    <p class="key-visual-reference">
      {{ keyVisualReference }}
    </p>
  </v-img>
</template>

<script setup>
defineProps({
  src: {
    type: String,
    default: "/image/no_image.png",
  },
  keyVisualReference: {
    type: String,
    default: "",
  },
});
</script>
