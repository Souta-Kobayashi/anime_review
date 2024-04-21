<template>
  <v-radio-group
    inline
    @update:model-value="
      e => $emit('update:broadcastSeason', e)
    "
  >
    <v-radio label="春アニメ" value="春アニメ"></v-radio>
    <v-radio label="夏アニメ" value="夏アニメ"></v-radio>
    <v-radio label="秋アニメ" value="秋アニメ"></v-radio>
    <v-radio label="冬アニメ" value="冬アニメ"></v-radio>
    <v-radio label="あとで選択する" value=""></v-radio>
  </v-radio-group>
</template>

<script setup>
defineEmits(["update:broadcastSeason"]);
</script>
