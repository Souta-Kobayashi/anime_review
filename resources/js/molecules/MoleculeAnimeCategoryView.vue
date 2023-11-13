<template>
  <div>
    <dt
      class="anime-info-list-term d-flex justify-content-between"
    >
      <span>カテゴリ</span>
      <span
        v-if="isLoginStatus && !isEditorVisible"
        class="cursor-pointer"
        @click="
          $emit('editorVisibleToggle', 'categories', true)
        "
      >
        <AtomPencilIcon />
      </span>
    </dt>
    <dd v-if="!isEditorVisible" class="anime-info-category">
      <v-chip
        v-for="(category, index) in categories"
        :key="index"
        variant="tonal"
        class="me-2 mb-2"
        >{{ category }}
      </v-chip>
    </dd>
    <dd v-else="isEditorVisible">
      <v-select
        class="anime-info-text"
        v-model="categoriesLocal"
        :items="categoryItems"
        chips
        variant="underlined"
        label="カテゴリを選択"
        multiple
      ></v-select>
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="
          $emit(
            'updateAnimeInfo',
            'categories',
            categoriesLocal
          )
        "
        @close-editor="
          $emit('editorVisibleToggle', 'categories', false)
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import AtomPencilIcon from '../atoms/icon/AtomPencilIcon.vue';
import MoleculeUpdateAndCancelButton from '../molecules/MoleculeUpdateAndCancelButton.vue';

const props = defineProps({
  categories: {
    type: Array,
    default: [],
  },
  categoryItems: {
    type: Array,
    default: [],
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

const categoriesLocal = ref(props.categories);

watch(
  () => props.categories,
  v => {
    categoriesLocal.value = v;
  }
);
</script>
