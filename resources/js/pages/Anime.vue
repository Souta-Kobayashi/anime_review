<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">アニメ一覧</h2>
    <v-container class="position-relative">
      <v-row align="start">
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
      <AtomPagination
        :pagination-length="paginationLength"
        @page-change="pageChange"
      />
    </v-container>
  </main>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import { ref } from 'vue';
import Snackbar from '../components/Snackbar.vue';
import AnimeCard from '../components/AnimeCard.vue';
import AtomPagination from '../atoms/pagination/AtomPagination.vue';
import { useFetchAnimeList } from '../composables/useFetchAnimeList';
import { useHelpers } from '../composables/useHelpers';

const { fetchAnimeList } = useFetchAnimeList();
const helpers = useHelpers();
const pageSize = 20;
const paginationLength = ref(0);
const displayAnimeList = ref([]);
let animeList = [];

// アニメ一覧取得
(async () => {
  animeList = await fetchAnimeList();
  if (animeList === null) {
    return;
  }
  // ページネーションのlength
  paginationLength.value = Math.ceil(
    animeList.length / pageSize
  );
  displayAnimeList.value = helpers.sliceArray(
    animeList,
    pageSize
  );
})();

// アニメ表示リストを更新
const pageChange = pageNumber => {
  displayAnimeList.value = animeList.slice(
    pageSize * (pageNumber - 1),
    pageSize * pageNumber
  );
};
</script>

<style lang="scss" scoped></style>
