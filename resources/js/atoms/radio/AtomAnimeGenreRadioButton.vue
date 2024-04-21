<template>
  <v-radio-group
    label="ジャンル"
    @update:model-value="e => $emit('update:genre', e)"
  >
    <v-radio
      class="anime-genre"
      label="TVアニメ"
      value="10"
    ></v-radio>
    <v-radio
      class="anime-genre"
      label="劇場版アニメ"
      value="20"
    ></v-radio>
    <v-radio
      class="anime-genre"
      label="あとで選択する"
      value=""
    ></v-radio>
  </v-radio-group>
</template>

<script setup>
defineProps({
  genre: {
    type: String,
    default: "",
  },
});
defineEmits(["update:genre"]);
</script>
