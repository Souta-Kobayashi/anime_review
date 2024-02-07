<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">新着アニメ</h2>
    <v-container class="position-relative">
      <AnimeCard
        id="more-contents"
        :display-anime-list="displayAnimeList"
      />
      <AtomToAnimeListButton v-if="showMoreButton" />
    </v-container>
  </main>
  <BaseFooter />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AnimeCard from '../organisms/AnimeCard.vue';
import AtomToAnimeListButton from '../atoms/button/AtomToAnimeListButton.vue';
import { useFetchAnimeList } from '../composables/useFetchAnimeList';
import { useHelpers } from '../composables/useHelpers';

const { fetchAnimeList } = useFetchAnimeList();
const helpers = useHelpers();
const maxAnimeItems = 5;
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
    if (animeList.length > 5) {
      addMoreButtonClass();
    }
  }
};

const addMoreButtonClass = () => {
  // もっと見るボタン、グラデーションクラスを追加
  showMoreButton.value = true;
  document
    .getElementById('more-contents')
    .classList.add('more-contents');
};

onMounted(() => {
  fetchAndDisplayAnimeList();
});
</script>
