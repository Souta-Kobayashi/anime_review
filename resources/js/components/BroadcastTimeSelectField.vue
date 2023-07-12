<template>
  <label class="form-label" v-if="!hasLabel">放送時期</label>
  <div
    v-show="!toggleBroadcastTime"
    id="form-inline-group"
    class="display-flex-responsive"
  >
    <select class="form-select" id="broadcastYear">
      <option
        v-for="year in years"
        :key="year"
        :value="year"
        :selected="year === currentYear"
      >
        {{ year }}年
      </option>
    </select>
    <div
      class="d-flex form-control select-list-flex"
      id="broadcastSeason"
      @click="setActiveClass($event)"
    >
      <button
        type="button"
        id="spring"
        class="w-100 border-end"
        :class="{
          active: selectedSeasonButton === 'spring',
        }"
      >
        春アニメ
      </button>
      <button
        type="button"
        id="summer"
        class="w-100 border-end"
        :class="{
          active: selectedSeasonButton === 'summer',
        }"
      >
        夏アニメ
      </button>
      <button
        type="button"
        id="autumn"
        class="w-100 border-end"
        :class="{
          active: selectedSeasonButton === 'autumn',
        }"
      >
        秋アニメ
      </button>
      <button
        type="button"
        id="winter"
        class="w-100"
        :class="{
          active: selectedSeasonButton === 'winter',
        }"
      >
        冬アニメ
      </button>
    </div>
  </div>
</template>

<script setup>
import { inject } from 'vue';

defineProps({
  toggleBroadcastTime: {
    type: Boolean,
    default: false,
  },
  hasLabel: {
    type: Boolean,
    default: false,
  },
});

// 親componentからデータ注入
const { selectedSeasonButton, setActiveClass } = inject('season');

// 放送時期の西暦プルダウン作成
const currentYear = new Date().getFullYear(); // 本年
const startYear = 1920;
const years = [];
for (let year = startYear; year <= currentYear; year++) {
  years.push(year); // 1920 ~ 本年までの配列
}
</script>