<template>
  <label class="form-label" v-if="!hasLabel">ジャンル</label>
  <div
    v-show="!toggleGenre"
    id="animeGenre"
    class="display-flex form-control select-list-flex"
    @click="setTargetId($event)"
  >
    <button
      type="button"
      id="tvAnime"
      class="w-100 border-end"
      :class="{
        active: selectedGenreButton === 'tvAnime',
      }"
    >
      TVアニメ
    </button>
    <button
      type="button"
      id="movieAnime"
      class="w-100"
      :class="{
        active: selectedGenreButton === 'movieAnime',
      }"
    >
      劇場版アニメ
    </button>
  </div>
</template>

<script setup>
import { useSetSelectedId } from '../composables/setSelectedId';

defineProps({
  toggleGenre: {
    type: Boolean,
    default: false,
  },
  hasLabel: {
    type: Boolean,
    default: false,
  },
});

const { selectedGenreButton, setTargetId } = useSetSelectedId();
</script>