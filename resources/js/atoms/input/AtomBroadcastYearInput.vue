<template>
  <v-select
    clearable
    label="放送時期"
    :items="years"
    variant="underlined"
    @update:model-value="
      e => $emit('update:broadcastYear', e)
    "
  ></v-select>
</template>

<script setup>
defineEmits(["update:broadcastYear"]);

// 放送時期の西暦プルダウン作成
const currentYear = new Date().getFullYear(); // 本年
const startYear = 1980;
const years = [];
for (let year = startYear; year <= currentYear; year++) {
  years.push(String(year) + "年"); // 1980 ~ 本年までの配列
}
</script>
