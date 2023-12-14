<template>
  <v-img :src="src" height="350" cover>
    <p class="key-visual-reference">
      {{ keyVisualReference }}
    </p>
  </v-img>
</template>

<script setup>
const props = defineProps({
  src: {
    type: String,
    default: 'storage/uploads/dummy.png',
  },
  keyVisualReference: {
    type: String,
    default: '',
  },
});
</script>
