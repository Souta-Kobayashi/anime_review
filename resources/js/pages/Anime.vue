<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">アニメ一覧</h2>
    <v-container class="position-relative">
      <AnimeCard :display-anime-list="displayAnimeList" />
      <AtomPagination
        v-model="currentPage"
        :pagination-length="paginationLength"
        @page-change="pageChange"
      />
    </v-container>
  </main>
  <BaseFooter />
</template>

<script setup>
import { ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import AnimeCard from '../organisms/AnimeCard.vue';
import AtomPagination from '../atoms/pagination/AtomPagination.vue';
import { useFetchAnimeList } from '../composables/useFetchAnimeList';
import { useVueScrollTo } from '../composables/useVueScrollTo';

const router = useRouter();
const route = useRoute();
const { fetchAnimeList } = useFetchAnimeList();
const pageSize = 5;
const paginationLength = ref(0);
const currentPage = ref(1);
const displayAnimeList = ref([]);
let animeList = [];
const { vueScrollTo, options } = useVueScrollTo(); // vue-scroll-to

// ページに応じたアニメをdisplayAnimeListにセット
const setPageAnimeItems = currentPage => {
  displayAnimeList.value = animeList.slice(
    pageSize * (currentPage - 1),
    pageSize * currentPage
  );
};

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

  // pageに応じたアイテムを出す
  currentPage.value = route.query.page - 0 || 1;
  setPageAnimeItems(currentPage.value);
})();

// ページネーションクリック時アニメ表示を更新
const pageChange = pageNumber => {
  // クエリパラメータ付与
  if (pageNumber > 1) {
    router.push({ query: { page: pageNumber } });
  } else {
    router.push({ query: {} });
  }

  setPageAnimeItems(pageNumber);
  // トップまでスクロール
  vueScrollTo.scrollTo('#app', options);
};
</script>
