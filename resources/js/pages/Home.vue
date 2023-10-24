<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">新着アニメ</h2>
    <v-container class="position-relative">
      <v-row align="start" id="more-contents">
        <AnimeCard
          v-for="anime in displayAnimeList"
          :key="anime.id"
          :id="anime.id"
          :anime-name="anime.animeName"
          :category="anime.category"
          :rating="anime.rating"
          :synopsis="anime.synopsis"
          :key-visual="anime.keyVisual"
          :key-visual-reference="anime.keyVisualReference"
        />
      </v-row>
      <AtomToAnimeListButton v-if="showMoreButton" />
    </v-container>
  </main>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Snackbar from '../components/Snackbar.vue';
import AnimeCard from '../components/AnimeCard.vue';
import AtomToAnimeListButton from '../atoms/button/AtomToAnimeListButton.vue';
import { useFetchAnimeList } from '../composables/useFetchAnimeList';
import { useHelpers } from '../composables/useHelpers';

const { fetchAnimeList } = useFetchAnimeList();
const helpers = useHelpers();
const maxAnimeItems = 20;
const showMoreButton = ref(false);
const displayAnimeList = ref([]);

// アニメ一覧取得
const fetchAndDisplayAnimeList = async () => {
  const animeList = await fetchAnimeList();
  if (animeList && animeList.length > 0) {
    // 20件にslice
    displayAnimeList.value = helpers.sliceArray(
      animeList,
      maxAnimeItems
    );
    if (animeList.length > 20) {
      addMoreButtonClass();
    }
  }
};

const addMoreButtonClass = () => {
  // もっと見るボタン、グラデーションクラスを削除
  showMoreButton.value = true;
  document
    .getElementsById('more-contents')[0]
    .classList.add('more-contents');
};

onMounted(() => {
  fetchAndDisplayAnimeList();
});
</script>

<style lang="scss" scoped></style>
