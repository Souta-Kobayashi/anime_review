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
      <span v-if="categories.length === 0">未選択</span>
      <v-chip
        v-for="(category, index) in categories"
        v-else
        :key="index"
        variant="tonal"
        class="me-2 mb-2"
        >{{ category.category_name }}
      </v-chip>
    </dd>
    <dd v-else>
      <v-select
        v-model="currentCategoriesLocal"
        class="anime-info-text"
        :items="categoryItemsLocal"
        chips
        variant="underlined"
        label="カテゴリを選択"
        theme="dark"
        multiple
      ></v-select>
      <MoleculeUpdateAndCancelButton
        :loading="isLoading"
        @update-anime-info="updateAnimeInfo"
        @close-editor="
          $emit('editorVisibleToggle', 'categories', false)
        "
      />
    </dd>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import AtomPencilIcon from "../../atoms/icon/AtomPencilIcon.vue";
import MoleculeUpdateAndCancelButton from "../buttonGroup/MoleculeUpdateAndCancelButton.vue";

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
  categoryItems: {
    type: Array,
    default: () => [],
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
  "updateAnimeInfo",
  "editorVisibleToggle",
]);

const currentCategoriesLocal = ref([]);
const categoryItemsLocal = ref([]);

const categorySet = (categories, type) => {
  if (type === "current") {
    currentCategoriesLocal.value = categories.map(
      item => item.category_name
    );
  } else if (type === "list") {
    categoryItemsLocal.value = categories.map(
      item => item.category_name
    );
  }
};

// 初期データセット
(async () => {
  categorySet(props.categories, "current");
  categorySet(props.categoryItems, "list");
})();

watch(
  () => props.categories,
  v => {
    categorySet(v, "current");
  }
);

watch(
  () => props.categoryItems,
  v => {
    categorySet(v, "list");
  }
);

const updateAnimeInfo = () => {
  // カテゴリidと一緒にリクエストするための処理
  const filteredCategoryItems = props.categoryItems.filter(
    item =>
      currentCategoriesLocal.value.includes(
        item.category_name
      )
  );

  emit(
    "updateAnimeInfo",
    "categories",
    filteredCategoryItems
  );
};
</script>
