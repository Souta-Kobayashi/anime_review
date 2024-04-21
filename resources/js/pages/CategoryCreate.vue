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
</template>

<script setup>
import { ref, reactive } from "vue";
import router from "../router";
import { useApiRequest } from "../composables/useApiRequest";
import AtomCategoryNameInput from "../atoms/input/AtomCategoryNameInput.vue";
import AtomCategoryCreateSubmitButton from "../atoms/button/AtomCategoryCreateSubmitButton.vue";

const form = reactive({
  categoryName: "",
});
const isPassed = ref(false);
const serverErrorMessage = reactive({});
// composables
const { loading, setLoading, apiPostRequest } =
  useApiRequest();

const submitCategoryRegister = async () => {
  setLoading(true);
  const result = await apiPostRequest(
    "/api/category/create",
    { name: form.categoryName }
  );

  if (result.status === 201) {
    router.push({ name: "category" });
  } else if (result.status === 422) {
    // サーバーエラーメッセージを生成
    for (const key in result.data.errors) {
      serverErrorMessage[key] = result.data.errors[key];
    }
  }

  setLoading(false);
};
</script>
