<template>
  <v-sheet class="anime-info-sheet pt-5">
    <MoleculeAnimeCategoryView
      class="mb-2"
      :categories="categories"
      :category-items="categoryItems"
      :is-login-status="isLoginStatus"
      :is-editor-visible="isEditorVisible.categories"
      :is-loading="isLoading.categories"
      @editor-visible-toggle="editorVisibleToggle"
      @update-anime-info="
        (type, data) => $emit('updateAnimeInfo', type, data)
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
        (type, data) => $emit('updateAnimeInfo', type, data)
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
        (type, data) => $emit('updateAnimeInfo', type, data)
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
        (type, data) => $emit('updateAnimeInfo', type, data)
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
        (type, data) => $emit('updateAnimeInfo', type, data)
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
        (type, data) => $emit('updateAnimeInfo', type, data)
      "
    />
  </v-sheet>
</template>

<script setup>
import { ref } from 'vue';
import { useVueRouterBeforeRouteLeave } from '../composables/useVueRouterBeforeRouteLeave';
import MoleculeAnimeCategoryView from '../molecules/dataDisplay/MoleculeAnimeCategoryView.vue';
import MoleculeAnimeWatchedStatusView from '../molecules/dataDisplay/MoleculeAnimeWatchedStatusView.vue';
import MoleculeAnimeBroadcastView from '../molecules/dataDisplay/MoleculeAnimeBroadcastView.vue';
import MoleculeAnimeGenreView from '../molecules/dataDisplay/MoleculeAnimeGenreView.vue';
import MoleculeAnimeSynopsisView from '../molecules/dataDisplay/MoleculeAnimeSynopsisView.vue';
import MoleculeAnimeCommentView from '../molecules/dataDisplay/MoleculeAnimeCommentView.vue';

const props = defineProps({
  categories: {
    type: Array,
    default: [],
  },
  categoryItems: {
    type: Array,
    default: [],
  },
  watchedStatus: {
    type: Number,
    default: null,
  },
  broadcastDate: {
    type: String,
    default: '',
  },
  genre: {
    type: Number,
    default: null,
  },
  synopsis: {
    type: String,
    default: '',
  },
  comment: {
    type: String,
    default: '',
  },
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  isLoading: {
    type: Object,
    default: {},
  },
});
const emit = defineEmits(['updateAnimeInfo']);

const isEditorVisible = ref({
  categories: false,
  watchedStatus: false,
  broadcastDate: false,
  genre: false,
  synopsis: false,
  comment: false,
});
const { setFormDirty } = useVueRouterBeforeRouteLeave(); // 入力途中でページ遷移時ダイアログを表示

// 選択されたフィールドのエディターの表示非表示を制御
const editorVisibleToggle = (type, isVisible) => {
  setFormDirty(isVisible);
  isEditorVisible.value[type] = isVisible;
};

defineExpose({
  editorVisibleToggle,
});
</script>
