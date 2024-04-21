<template>
  <v-sheet class="pt-5">
    <template v-if="isFetching">
      <v-sheet>
        <v-skeleton-loader
          v-for="index in animeInfoEditorCount"
          :key="index"
          type="heading,text"
        ></v-skeleton-loader>
      </v-sheet>
    </template>

    <template v-else>
      <MoleculeAnimeCategoryView
        class="mb-2"
        :categories="categories"
        :category-items="categoryItems"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.categories"
        :is-loading="isLoading.categories"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
      <MoleculeAnimeWatchedStatusView
        class="mb-4"
        :watched-status="watchedStatus"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.watchedStatus"
        :is-loading="isLoading.watched_status"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
      <MoleculeAnimeBroadcastView
        class="mb-4"
        :broadcast-date="broadcastDate"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.broadcastDate"
        :is-loading="isLoading.broadcast_date"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
      <MoleculeAnimeGenreView
        class="mb-4"
        :genre="genre"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.genre"
        :is-loading="isLoading.genre"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
      <MoleculeAnimeSynopsisView
        class="mb-4"
        :synopsis="synopsis"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.synopsis"
        :is-loading="isLoading.synopsis"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
      <MoleculeAnimeCommentView
        class="mb-4"
        :comment="comment"
        :is-login-status="isLoginStatus"
        :is-editor-visible="isEditorVisible.comment"
        :is-loading="isLoading.comment"
        @editor-visible-toggle="editorVisibleToggle"
        @update-anime-info="
          (type, data) =>
            $emit('updateAnimeInfo', type, data)
        "
      />
    </template>
  </v-sheet>
</template>

<script setup>
import { ref } from "vue";
import MoleculeAnimeCategoryView from "../molecules/dataDisplay/MoleculeAnimeCategoryView.vue";
import MoleculeAnimeWatchedStatusView from "../molecules/dataDisplay/MoleculeAnimeWatchedStatusView.vue";
import MoleculeAnimeBroadcastView from "../molecules/dataDisplay/MoleculeAnimeBroadcastView.vue";
import MoleculeAnimeGenreView from "../molecules/dataDisplay/MoleculeAnimeGenreView.vue";
import MoleculeAnimeSynopsisView from "../molecules/dataDisplay/MoleculeAnimeSynopsisView.vue";
import MoleculeAnimeCommentView from "../molecules/dataDisplay/MoleculeAnimeCommentView.vue";

defineProps({
  isFetching: {
    type: Boolean,
    default: true,
  },
  categories: {
    type: Array,
    default: () => [],
  },
  categoryItems: {
    type: Array,
    default: () => [],
  },
  watchedStatus: {
    type: Number,
    default: null,
  },
  broadcastDate: {
    type: String,
    default: "",
  },
  genre: {
    type: Number,
    default: null,
  },
  synopsis: {
    type: String,
    default: "",
  },
  comment: {
    type: String,
    default: "",
  },
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  isLoading: {
    type: Object,
    default: () => ({}),
  },
});
const emit = defineEmits([
  "updateAnimeInfo",
  "setNavigationBlocked",
]);

const isEditorVisible = ref({
  categories: false,
  watchedStatus: false,
  broadcastDate: false,
  genre: false,
  synopsis: false,
  comment: false,
});
const animeInfoEditorCount = 6;

// 選択されたフィールドのエディターの表示非表示を制御
const editorVisibleToggle = (type, isVisible) => {
  emit("setNavigationBlocked", isVisible);
  isEditorVisible.value[type] = isVisible;
};

defineExpose({
  editorVisibleToggle,
});
</script>

<style lang="scss" scoped>
:deep(.v-skeleton-loader__heading) {
  height: 42px;
  margin: 12px 0;
}
:deep(.v-skeleton-loader__text) {
  margin: 12px 0;
}
</style>
