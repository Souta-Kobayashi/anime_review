<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">アニメ一覧</h2>
    <v-container class="position-relative">
      <AnimeCard :display-anime-list="displayAnimeList" />
      <AtomPagination
        :pagination-length="paginationLength"
        @page-change="pageChange"
      />
    </v-container>
  </main>
  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref } from 'vue';
import AtomSnackbar from '../atoms/notify/AtomSnackbar.vue';
import AnimeCard from '../organisms/AnimeCard.vue';
import AtomPagination from '../atoms/pagination/AtomPagination.vue';
import { useFetchAnimeList } from '../composables/useFetchAnimeList';
import { useHelpers } from '../composables/useHelpers';
import { useVueScrollTo } from '../composables/useVueScrollTo';

const { fetchAnimeList } = useFetchAnimeList();
const helpers = useHelpers();
const pageSize = 5;
const paginationLength = ref(0);
const displayAnimeList = ref([]);
let animeList = [];
const { vueScrollTo, options } = useVueScrollTo(); // vue-scroll-to

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

// ページネーションクリック時アニメ表示を更新
const pageChange = pageNumber => {
  displayAnimeList.value = animeList.slice(
    pageSize * (pageNumber - 1),
    pageSize * pageNumber
  );
  // トップまでスクロール
  vueScrollTo.scrollTo('#app', options);
};
</script>
