<template>
  <v-container>
    <table class="w-100">
      <tbody>
        <CategoriesTableSkeltonLoader
          :is-fetching="isFetching"
        />
      </tbody>
    </table>

    <v-table hover fixed-header>
      <thead>
        <tr>
          <th class="text-left">カテゴリ名</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <MoleculeCategoryTableRow
          v-for="category in categories"
          :key="category.id"
          :category-id="category.id"
          :category-name="category.category_name"
          @show-dialog="showDialog"
        />
      </tbody>

      <!-- dialog -->
      <CategoryEditDialog
        :is-dialog-edit="isEditDialogVisible"
        :edit-category-name="selectCategoryName"
        :category-update-error-data="
          categoryUpdateErrorData
        "
        @hide-dialog="hideDialog('edit')"
        @update-category="updateCategory"
      />
      <CategoryDestroyDialog
        :is-destroy-dialog-visible="isDestroyDialogVisible"
        :select-category-name="selectCategoryName"
        @hide-dialog="hideDialog('destroy')"
        @destroy-category="
          $emit('destroyCategory', selectCategoryId)
        "
      />
    </v-table>
  </v-container>
</template>

<script setup>
import { ref, watch } from 'vue';
import MoleculeCategoryTableRow from '../molecules/table/MoleculeCategoryTableRow.vue';
import CategoryEditDialog from '../organisms/CategoryEditDialog.vue';
import CategoryDestroyDialog from '../organisms/CategoryDestroyDialog.vue';
import CategoriesTableSkeltonLoader from '../organisms/CategoriesTableSkeltonLoader.vue';

const props = defineProps({
  isFetching: {
    type: Boolean,
    default: true,
  },
  categories: {
    type: Array,
    default: [],
  },
  isCategoryUpdated: {
    type: Boolean,
    default: null,
  },
  isCategoryDeleted: {
    type: Boolean,
    default: null,
  },
  categoryUpdateErrorData: {
    type: Object,
    default: null,
  },
});
const emit = defineEmits([
  'updateCategory',
  'destroyCategory',
]);

const isDestroyDialogVisible = ref(false);
const isEditDialogVisible = ref(false);

const selectCategoryId = ref(null);
const selectCategoryName = ref('');

const showDialog = (type, categoryId, categoryName) => {
  if (type === 'edit') {
    isEditDialogVisible.value = true;
  } else {
    isDestroyDialogVisible.value = true;
  }
  selectCategoryId.value = categoryId;
  selectCategoryName.value = categoryName;
};

const hideDialog = type => {
  if (type === 'edit') {
    isEditDialogVisible.value = false;
  } else {
    isDestroyDialogVisible.value = false;
  }
};

const updateCategory = newCategoryName => {
  emit(
    'updateCategory',
    newCategoryName,
    selectCategoryId.value
  );
};

watch(
  () => props.isCategoryUpdated,
  isCategoryUpdated => {
    isEditDialogVisible.value = isCategoryUpdated
      ? false
      : true;
  }
);
watch(
  () => props.isCategoryDeleted,
  isCategoryDeleted => {
    isDestroyDialogVisible.value = isCategoryDeleted
      ? false
      : true;
  }
);
</script>

<style lang="scss" scoped>
.v-container {
  max-width: 800px !important;
}
</style>
