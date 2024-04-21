<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">新着アニメ</h2>
    <AnimeCardSkeletonLoader
      :is-fetching="isFetching"
      :anime-card-count="maxAnimeItems"
    />
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
import { ref, onMounted } from "vue";
import { useFetchAnimeList } from "../composables/useFetchAnimeList";
import { useHelpers } from "../composables/useHelpers";
import AtomToAnimeListButton from "../atoms/button/AtomToAnimeListButton.vue";
import AnimeCard from "../organisms/AnimeCard.vue";
import AnimeCardSkeletonLoader from "../organisms/AnimeCardSkeletonLoader.vue";

const { fetchAnimeList } = useFetchAnimeList();
const helpers = useHelpers();
const maxAnimeItems = 5;
const showMoreButton = ref(false);
const displayAnimeList = ref([]);
const isFetching = ref(true);

// アニメ一覧取得
const fetchAndDisplayAnimeList = async () => {
  const animeList = await fetchAnimeList();
  isFetching.value = false;
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
  const moreContents =
    document.getElementById("more-contents");
  if (moreContents) {
    moreContents.classList.add("more-contents");
  }
};

onMounted(() => {
  fetchAndDisplayAnimeList();
});
</script>
