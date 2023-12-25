<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>ジャンル</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="$emit('editorVisibleToggle', 'genre', true)"
      >
        <AtomPencilIcon />
      </span>
    </dt>

    <dd v-if="!isEditorVisible" class="anime-info-text">
      {{ genreName }}
    </dd>
    <dd v-else="isEditorVisible">
      <MoleculeAnimeGenreRadioGroup
        v-model="genreLocal"
        inline
      />
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit('updateAnimeInfo', 'genre', genreLocal)
        "
        @close-editor="
          $emit('editorVisibleToggle', 'genre', false)
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import AtomPencilIcon from '../../atoms/icon/AtomPencilIcon.vue';
import MoleculeAnimeGenreRadioGroup from '../radioGroup/MoleculeAnimeGenreRadioGroup.vue';
import MoleculeUpdateAndCancelButton from '../buttonGroup/MoleculeUpdateAndCancelButton.vue';

const props = defineProps({
  genre: {
    type: Number,
    default: null,
  },
  isLoginStatus: {
    type: Boolean,
    default: false,
  },
  isEditorVisible: {
    type: Boolean,
    default: false,
  },
  isLoading: {
    type: Boolean,
    default: false,
  },
});
const emit = defineEmits([
  'updateAnimeInfo',
  'editorVisibleToggle',
]);

const genreLocal = ref(props.genre);

watch(
  () => props.genre,
  v => {
    genreLocal.value = v;
  }
);

// prettier-ignore
const genreName = computed(() =>
  props.genre === 10 ? 'TVアニメ'
  : props.genre === 20 ? '劇場版アニメ'
  : '未選択'
);
</script>
