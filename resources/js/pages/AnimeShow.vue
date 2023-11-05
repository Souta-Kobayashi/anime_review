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
          :close-dialog="closeDialog"
          @save-rating="updateRating"
        />
      </v-row>

      <!-- アニメ名、サムネイルもフィールド内に加える -->
      <v-row>
        <v-col
          style="
            background: green;
            color: white;
            height: 500px;
          "
        >
          <div>anime information</div>
          <AnimeInfoEditor
            @update-anime-info="updateAnimeInfo"
          />
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <div>delete text</div>
          <AnimeDelete @delete-anime="deleteAnime" />
        </v-col>
      </v-row>
    </v-container>
  </main>

  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { SNACKBAR_COLOR } from '../const/SnackbarColor';
import { ERROR_MESSAGES } from '../const/Messages';
import { useSnackbar } from '../composables/useSnackbar';
import { useApiRequest } from '../composables/useApiRequest';
import AnimeRating from '../organisms/AnimeRating.vue';
import AnimeInfoEditor from '../organisms/AnimeInfoEditor.vue';
import AnimeDelete from '../organisms/AnimeDelete.vue';
import AtomSnackbar from '../atoms/AtomSnackbar.vue';

const { apiGetRequest, apiPutRequest, apiDeleteRequest } =
  useApiRequest();
const { setSnackbar } = useSnackbar();

const route = useRoute();
const animeDetail = ref({});
const baseUrl = `/api${route.path}`;
const closeDialog = ref(false);

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

// 初期データセット アニメ詳細
(async () => {
  await fetchAnimeDetail();
})();

// レーティング更新のAPIリクエスト
const updateRating = async ratingItems => {
  closeDialog.value = false;
  console.log(ratingItems);
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
const updateAnimeInfo = () => {};
const deleteAnime = () => {};
</script>

<style lang="scss" scoped>
.v-container {
  padding: 16px !important;
  @media (min-width: 1280px) {
    max-width: 1200px !important;
  }
}
</style>
