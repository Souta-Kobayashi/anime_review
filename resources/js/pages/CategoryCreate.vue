<template>
  <BaseHeader />
  <main>
    <v-sheet class="pa-6 mx-auto" max-width="1000px">
      <h4 class="text-center">カテゴリ登録</h4>
      <v-form v-model="isPassed" @submit.prevent>
        <v-container>
          <AtomCategoryNameInput
            v-model:category-name="form.categoryName"
            :server-error-message="serverErrorMessage"
          />
          <AtomCategoryCreateSubmitButton
            :is-passed="isPassed"
            :loading="loading"
            @submit-category-register="
              submitCategoryRegister
            "
          />
        </v-container>
      </v-form>
    </v-sheet>
  </main>
  <BaseFooter />
  <AtomSnackbar />
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useApiRequest } from '../composables/useApiRequest';
import AtomSnackbar from '../atoms/AtomSnackbar.vue';
import AtomCategoryNameInput from '../atoms/input/AtomCategoryNameInput.vue';
import AtomCategoryCreateSubmitButton from '../atoms/button/AtomCategoryCreateSubmitButton.vue';

const form = reactive({
  categoryName: '',
});
const isPassed = ref(false);
const serverErrorMessage = reactive({});
// composables
const { loading, setLoading, apiPostRequest } =
  useApiRequest();

const submitCategoryRegister = async () => {
  setLoading(true);
  const result = await apiPostRequest(
    '/api/category/create',
    form
  );

  // このフォーマットで通る
  // result.response.data.errors = {
  //   name: ['nameは必ず指定してください。'],
  //   password: ['passwordは必ず指定してください。'],
  // };

  // TODO: バックエンド側実装後修正する
  // サーバー側バリデーションチェックの戻り値からエラーメッセージセット
  // if () {

  // }

  // for (const key in result.data.errors) {
  //   serverErrorMessage[key] = result.data.errors[key];
  // }

  setLoading(false);
};
</script>
