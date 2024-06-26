<template>
  <template v-if="hasAnimeDetail">
    <BaseHeader />
    <main>
      <v-container>
        <v-row class="pc-anime-title-wrapper">
          <v-col>
            <h4 class="show-page-anime-title">
              <v-skeleton-loader
                v-if="isFetching"
                type="heading"
              ></v-skeleton-loader>
              <template v-else>
                {{ animeDetail.anime_name }}
              </template>
            </h4>
          </v-col>
        </v-row>

        <v-row class="sp-head">
          <v-col cols="6" sm="5" md="4" lg="3">
            <v-skeleton-loader
              v-if="isFetching"
              type="image"
            ></v-skeleton-loader>
            <v-img
              v-else
              :src="animeDetail.key_visual"
              height="350"
              alt="アニメのキービジュアル画像"
              cover
            >
              <p class="key-visual-reference">
                {{ animeDetail.key_visual_reference }}
              </p>
            </v-img>
          </v-col>
          <v-col class="sp-anime-title-wrapper">
            <h4 class="show-page-anime-title">
              <v-skeleton-loader
                v-if="isFetching"
                type="heading"
              ></v-skeleton-loader>
              <template v-else>
                {{ animeDetail.anime_name }}
              </template>
            </h4>
          </v-col>

          <AnimeRating
            :is-fetching="isFetching"
            :review-average="animeDetail.review_average"
            :review-story="animeDetail.review_story"
            :review-drawing="animeDetail.review_drawing"
            :review-voice-actor="
              animeDetail.review_voice_actor
            "
            :review-music="animeDetail.review_music"
            :review-characters="
              animeDetail.review_characters
            "
            :close-dialog="closeRatingDialog"
            @save-rating="updateRating"
            @set-navigation-blocked="setNavigationBlocked"
          />
        </v-row>

        <v-row class="w-100 m-auto flex-column">
          <AnimeInfoEditor
            ref="animeInfoEditorRef"
            :is-fetching="isFetching"
            :categories="animeDetail.categories"
            :category-items="allCategoryItems"
            :watched-status="animeDetail.watched_status"
            :broadcast-date="animeDetail.broadcast_date"
            :genre="animeDetail.genre"
            :synopsis="animeDetail.synopsis"
            :comment="animeDetail.comment"
            :is-login-status="isLoginStatus"
            :is-loading="isLoading"
            @update-anime-info="updateAnimeInfo"
            @set-navigation-blocked="setNavigationBlocked"
          />
        </v-row>

        <v-row>
          <v-col class="text-end">
            <AnimeDelete
              v-if="isLoginStatus"
              :anime-name="animeDetail.anime_name"
              @destroy-anime="destroyAnime"
            />
          </v-col>
        </v-row>
      </v-container>

      <LeavingConfirmationDialog
        v-model="showConfirmationDialog"
        @go-next-page="goNextPage"
        @hide-navigation-confirm-dialog="
          hideNavigationConfirmDialog
        "
      />
    </main>
    <BaseFooter />
  </template>
  <template v-else>
    <NotFoundView />
  </template>
</template>

<script setup>
import { ref } from "vue";
import router from "../router";
import { useRoute } from "vue-router";
import { useApiRequest } from "../composables/useApiRequest";
import { useIsLoggedIn } from "../composables/useIsLoggedIn";
import { useFetchCategories } from "../composables/useFetchCategories";
import { useHelpers } from "../composables/useHelpers";
import { useVueRouterBeforeRouteLeave } from "../composables/useVueRouterBeforeRouteLeave";
import AnimeRating from "../organisms/AnimeRating.vue";
import AnimeInfoEditor from "../organisms/AnimeInfoEditor.vue";
import AnimeDelete from "../organisms/AnimeDelete.vue";
import LeavingConfirmationDialog from "../organisms/LeavingConfirmationDialog.vue";
import NotFoundView from "../pages/NotFoundView.vue";

const { apiGetRequest, apiPutRequest, apiDeleteRequest } =
  useApiRequest();
const { fetchCategories } = useFetchCategories();
const { isLoginStatus } = useIsLoggedIn();
const helpers = useHelpers();

const route = useRoute();
const animeDetail = ref({});
const allCategoryItems = ref([]);
const baseUrl = `/api${route.path}`;
const closeRatingDialog = ref(false);
const animeInfoEditorRef = ref(null);
// const hasMounted = ref(false);
const hasAnimeDetail = ref(true);
const isFetching = ref(true);

const isLoading = ref({
  categories: false,
  watched_status: false,
  broadcast_date: false,
  genre: false,
  synopsis: false,
  comment: false,
});

const {
  setNavigationBlocked,
  goNextPage,
  hideNavigationConfirmDialog,
  showConfirmationDialog,
} = useVueRouterBeforeRouteLeave(); // 入力途中でページ遷移時ダイアログを表示

// 全カテゴリの取得
const fetchAllCategories = async () => {
  allCategoryItems.value = await fetchCategories();
  if (allCategoryItems.value === null) {
    return;
  }
};

// アニメ詳細取得APIリクエスト
const fetchAnimeDetail = async () => {
  const result = await apiGetRequest(`${baseUrl}/`);
  isFetching.value = false;
  if (result.status === 200) {
    animeDetail.value = result.data;
    // 各評価がオール0の場合は総合評価を棒線
    if (animeDetail.value.review_average === "0") {
      animeDetail.value.review_average = "ー";
    }
  } else {
    // NotFoundを表示
    hasAnimeDetail.value = false;
  }
};

// 初期データセット
(async () => {
  fetchAnimeDetail();
  fetchAllCategories();
})();

// レーティング更新のAPIリクエスト
const updateRating = async ratingItems => {
  closeRatingDialog.value = false;
  const form = ratingItems.reduce((result, item) => {
    result[item.ratingName] = item.ratingValue;
    return result;
  }, {});

  const result = await apiPutRequest(
    `${baseUrl}/rating`,
    form
  );

  if (result.status === 200) {
    // ダイアログを閉じる
    closeRatingDialog.value = true;
    // アニメ表示をリフレッシュ
    await fetchAnimeDetail();
  }
};

// prettier-ignore
// 更新前の値と同値もしくはunMounted状態はfalseを返す
const shouldSkipUpdate = (type, data) => {
  // broadcast_dataは,を置換
  if (type === 'broadcast_date') {
    data = data.replace(/,/g, '　');
  }

  // NOTE: categoryがプロキシされたオブジェクトの値のためJSON.stringifyで文字列変換し比較
  if (
    JSON.stringify(animeDetail.value[type]) === JSON.stringify(data)
    // || !hasMounted
  ) {
    // エディター閉じる
    animeInfoEditorRef.value?.editorVisibleToggle(
      helpers.toCamelCase(type),
      false
    );
    isLoading.value[type] = false;
    return false;
  }
  return true;
};

// 放送時期のデータをAPIリクエスト用に加工
const formatBroadcastForBackend = (type, data) => {
  if (type === "broadcast_date") {
    // 放送西暦のプルダウンは値がないとnullとなるため空文字に置換
    data.year = data.year ?? "";
    return `${data.year},${data.season}`;
  }
  return data;
};

// 放送時期のデータをフロント表示用に加工
const formatBroadcastForDisplay = (type, data) => {
  if (!(type === "broadcast_date")) {
    return data;
  }

  const pattern = /^\d{4}.*アニメ/;
  if (pattern.test(data)) {
    // 西暦、季節ともに入力されている場合はスペースに置換
    // e.g.) 2023年,春アニメ
    data = data.replace(/,/g, " ");
  } else {
    // 西暦、季節どちらか入力されている場合は空文字に置換
    // e.g.) ,春アニメ | 2023年,
    data = data.replace(/,/g, "");
  }
  return data;
};

// アニメ情報の更新
const updateAnimeInfo = async (type, data) => {
  isLoading.value[type] = true;
  // 放送時期はデータ加工
  data = formatBroadcastForBackend(type, data);
  // APIリクエストの送信判定
  if (!shouldSkipUpdate(type, data)) return;

  // APIリクエスト
  const form = { [type]: data };
  const result = await apiPutRequest(
    `${baseUrl}/info`,
    form
  );

  if (result.status === 200) {
    // 放送時期のデータの場合はフロント表示用に修正
    data = formatBroadcastForDisplay(type, data);
    // フロント側値の更新
    animeDetail.value[type] = data;
    // エディター閉じる
    animeInfoEditorRef.value?.editorVisibleToggle(
      helpers.toCamelCase(type),
      false
    );
  }
  isLoading.value[type] = false;
};

// アニメの削除
const destroyAnime = async () => {
  const result = await apiDeleteRequest(baseUrl);
  if (result.status === 200) {
    // 削除後homeにリダイレクト
    router.push({ name: "home" });
  }
};

// TODO: リリース後数週間様子見て不要であれば削除
// onMounted(() => {
//   console.log('mounted');
//   hasMounted.value = true;
// });
</script>

<style lang="scss" scoped>
.v-container {
  padding: 16px !important;
  @media (min-width: 1280px) {
    max-width: 1200px !important;
  }
}
.show-page-anime-title :deep(.v-skeleton-loader__heading) {
  margin: 10px 0 0;
  height: 30px;
}
</style>
