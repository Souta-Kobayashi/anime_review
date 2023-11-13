<template>
  <v-sheet class="anime-info-sheet pt-5">
    <MoleculeAnimeCategoryView
      class="mb-2"
      :categories="categories"
      :category-items="categoryItems"
      :is-login-status="isLoginStatus"
      :is-editor-visible="isEditorVisible.categories"
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
      @editor-visible-toggle="editorVisibleToggle"
      @update-anime-info="
        (type, data) => $emit('updateAnimeInfo', type, data)
      "
    />
  </v-sheet>
</template>

<script setup>
import { ref } from 'vue';
import MoleculeAnimeCategoryView from '../molecules/MoleculeAnimeCategoryView.vue';
import MoleculeAnimeWatchedStatusView from '../molecules/MoleculeAnimeWatchedStatusView.vue';
import MoleculeAnimeBroadcastView from '../molecules/MoleculeAnimeBroadcastView.vue';
import MoleculeAnimeGenreView from '../molecules/MoleculeAnimeGenreView.vue';
import MoleculeAnimeSynopsisView from '../molecules/MoleculeAnimeSynopsisView.vue';
import MoleculeAnimeCommentView from '../molecules/MoleculeAnimeCommentView.vue';

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

// 選択されたフィールドのエディターの表示非表示を制御
const editorVisibleToggle = (type, isVisible) => {
  isEditorVisible.value[type] = isVisible;
};

defineExpose({
  editorVisibleToggle,
});
</script>
