<template>
  <BaseHeader />
  <main>
    <h2 class="p-4 text-center">カテゴリ一覧</h2>
    <CategoriesTable
      :is-fetching="isFetching"
      :categories="categories"
      :is-category-updated="isCategoryUpdated"
      :is-category-deleted="isCategoryDeleted"
      :category-update-error-data="categoryUpdateErrorData"
      @update-category="updateCategory"
      @destroy-category="destroyCategory"
    />
  </main>
  <BaseFooter />
</template>

<script setup>
import { ref } from 'vue';
import { useApiRequest } from '../composables/useApiRequest';
import CategoriesTable from '../organisms/CategoriesTable.vue';

const { apiGetRequest, apiPutRequest, apiDeleteRequest } =
  useApiRequest();

const categories = ref([]);
const isCategoryUpdated = ref(null);
const isCategoryDeleted = ref(null);
const categoryUpdateErrorData = ref(null);
const isFetching = ref(true);

// カテゴリの取得
const fetchCategory = async () => {
  const result = await apiGetRequest('/api/category');
  isFetching.value = false;
  if (result.status === 200) {
    categories.value = result.data;
  }
};

// 初期データセット
(async () => {
  await fetchCategory();
})();

// カテゴリ名の更新
const updateCategory = async (categoryName, id) => {
  isCategoryUpdated.value = false;
  const result = await apiPutRequest(
    `/api/category/${id}`,
    { name: categoryName }
  );

  if (result.status === 200) {
    isCategoryUpdated.value = true;
    // カテゴリー表示をリフレッシュ
    await fetchCategory();
  } else {
    categoryUpdateErrorData.value = result.data.errors;
  }
};

// カテゴリの削除
const destroyCategory = async id => {
  isCategoryDeleted.value = false;
  const result = await apiDeleteRequest(
    `/api/category/${id}`
  );

  if (result.status === 200) {
    isCategoryDeleted.value = true;
    // カテゴリー表示をリフレッシュ
    await fetchCategory();
  }
};
</script>
