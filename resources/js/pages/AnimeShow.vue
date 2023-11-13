<template>
  <BaseHeader />
  <main>
    <v-container>
      <v-row class="pc-anime-title">
        <v-col>
          <h4>{{ animeDetail.anime_name }}</h4>
        </v-col>
      </v-row>

      <v-row class="sp-head">
        <v-col cols="5" sm="5" md="4" lg="3">
          <v-img
            :src="animeDetail.key_visual"
            height="350"
            cover
          >
            <p class="key-visual-reference">
              {{ animeDetail.key_visual_reference }}
            </p>
          </v-img>
        </v-col>
        <v-col class="sp-anime-title">
          <h4>{{ animeDetail.anime_name }}</h4>
        </v-col>

        <AnimeRating
          :review-average="animeDetail.review_average"
          :review-story="animeDetail.review_story"
          :review-drawing="animeDetail.review_drawing"
          :review-voice-actor="
            animeDetail.review_voice_actor
          "
          :review-music="animeDetail.review_music"
          :review-characters="animeDetail.review_characters"
          :close-dialog="closeRatingDialog"
          @save-rating="updateRating"
        />
      </v-row>

      <v-row class="w-100 m-auto flex-column">
        <AnimeInfoEditor
          v-if="isDataReady"
          :categories="animeDetail.categories"
          :categoryItems="categoryItems"
          :watched-status="animeDetail.watched_status"
          :broadcast-date="animeDetail.broadcast_date"
          :genre="animeDetail.genre"
          :synopsis="animeDetail.synopsis"
          :comment="animeDetail.comment"
          :is-login-status="isLoginStatus"
          :is-loading="isLoading"
          @update-anime-info="updateAnimeInfo"
          ref="animeInfoEditorRef"
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
  </main>

  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import router from '../router';
import { useRoute } from 'vue-router';
import { SNACKBAR_COLOR } from '../const/SnackbarColor';
import { ERROR_MESSAGES } from '../const/Messages';
import { useSnackbar } from '../composables/useSnackbar';
import { useApiRequest } from '../composables/useApiRequest';
import { useIsLoggedIn } from '../composables/useIsLoggedIn';
import { useFetchCategories } from '../composables/useFetchCategories';
import { useHelpers } from '../composables/useHelpers';
import AnimeRating from '../organisms/AnimeRating.vue';
import AnimeInfoEditor from '../organisms/AnimeInfoEditor.vue';
import AnimeDelete from '../organisms/AnimeDelete.vue';
import AtomSnackbar from '../atoms/AtomSnackbar.vue';

const { apiGetRequest, apiPutRequest, apiDeleteRequest } =
  useApiRequest();
const { setSnackbar } = useSnackbar();
const { fetchCategories } = useFetchCategories();
const { isLoginStatus, isDataReady } = useIsLoggedIn();
const helpers = useHelpers();

const route = useRoute();
const animeDetail = ref({});
const categoryItems = ref([]);
const baseUrl = `/api${route.path}`;
const closeRatingDialog = ref(false);
const animeInfoEditorRef = ref(null);
const hasMounted = ref(false);

const isLoading = ref({
  categories: false,
  watched_status: false,
  broadcast_date: false,
  genre: false,
  synopsis: false,
  comment: false,
});

// カテゴリの取得
const fetchCategoryItems = async () => {
  categoryItems.value = await fetchCategories();
  if (categoryItems.value === null) {
    return;
  }
};

// アニメ詳細取得APIリクエスト
const fetchAnimeDetail = async () => {
  const result = await apiGetRequest(`${baseUrl}/`);
  if (result.status === 200) {
    animeDetail.value = result.data;
    // 各評価がオール0の場合は総合評価を棒線
    if (animeDetail.value.review_average === '0') {
      animeDetail.value.review_average = 'ー';
    }
  } else {
    setSnackbar(
      ERROR_MESSAGES.animeGetFailed,
      SNACKBAR_COLOR.snackbarErrorColor
    );
  }
};

// 初期データセット
(async () => {
  fetchAnimeDetail();
  fetchCategoryItems();
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
    closeDialog.value = true;
    // カテゴリー表示をリフレッシュ
    await fetchAnimeDetail();
  }
};

// アニメ情報の更新
const updateAnimeInfo = async (type, data) => {
  isLoading.value[type] = true;
  // 放送時期はデータ加工
  if (type === 'broadcast_date') {
    data.year = data.year ?? '';
    // 前後のスペースをトル
    data = `${data.year}　${data.season}`.trim();
  }

  // 更新前と同値もしくはunMounted状態はreturn
  if (animeDetail.value[type] === data || !hasMounted) {
    // エディター閉じる
    animeInfoEditorRef.value?.editorVisibleToggle(
      helpers.toCamelCase(type),
      false
    );
    isLoading.value[type] = false;
    return;
  }

  // APIリクエスト
  const form = { [type]: data };
  const result = await apiPutRequest(
    `${baseUrl}/info`,
    form
  );

  if (result.status === 200) {
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
    router.push({ name: 'home' });
  }
};

onMounted(() => {
  hasMounted.value = true;
});
</script>

<style lang="scss" scoped>
.v-container {
  padding: 16px !important;
  @media (min-width: 1280px) {
    max-width: 1200px !important;
  }
}
</style>
