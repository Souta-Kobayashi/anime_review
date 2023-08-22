<template>
  <v-sheet class="pa-6 mx-auto" max-width="700px" width="100vw">
    <h4 class="text-center">ユーザー登録</h4>

    <v-form v-model="isPassed" @submit.prevent="submitRegisterUser">
      <v-container>
        <v-text-field
          v-model="form.name"
          :error-messages="getErrMessage('name')"
          color="primary"
          label="ユーザー名"
          variant="underlined"
          required
          prepend-inner-icon="mdi-account-outline"
          @blur="execVuelidate('name')"
        ></v-text-field>

        <v-text-field
          v-model="form.email"
          :error-messages="getErrMessage('email')"
          color="primary"
          label="メールアドレス"
          prepend-inner-icon="mdi-email-outline"
          variant="underlined"
          autocomplete="username"
          @blur="execVuelidate('email')"
        ></v-text-field>

        <v-text-field
          v-model="form.password"
          :type="showPassword ? 'text' : 'password'"
          :error-messages="getErrMessage('password')"
          :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :counter="8"
          color="primary"
          label="パスワード"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="underlined"
          hint="※8文字以上の英数字"
          autocomplete="new-password"
          @click:appendInner="showPassword = !showPassword"
          @blur="execVuelidate('password')"
        ></v-text-field>

        <v-text-field
          v-model="form.password_confirmation"
          :type="showConfirmationPassword ? 'text' : 'password'"
          :error-messages="getErrMessage('password_confirmation')"
          :append-inner-icon="
            showConfirmationPassword ? 'mdi-eye' : 'mdi-eye-off'
          "
          color="primary"
          label="パスワード(確認用)"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="underlined"
          autocomplete="new-password"
          @click:appendInner="
            showConfirmationPassword = !showConfirmationPassword
          "
          @blur="execVuelidate('password_confirmation')"
        ></v-text-field>

        <v-checkbox
          color="secondary"
          label="サイト規約に同意します"
        ></v-checkbox>
        <v-btn
          :disabled="!isPassed"
          :loading="loading"
          block
          color="blue-grey"
          size="large"
          type="submit"
          variant="elevated"
        >
          登録を完了する
        </v-btn>
      </v-container>
    </v-form>
  </v-sheet>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import { ref, reactive, computed } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { useSnackbar } from "../lib/useSnackbar";
import router from "../router";
import Snackbar from "../components/Snackbar.vue";

import {
  minLength,
  required,
  email,
  sameAs,
  helpers,
} from "@vuelidate/validators";

// snackbar
const { setSnackbar } = useSnackbar();

// form
const form = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});
const serverValidationErrMessage = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});
const showPassword = ref(false);
const showConfirmationPassword = ref(false);
const loading = ref(false);
const isPassed = ref(false);

// validation
// エラーメッセージの日本語化対応
const requiredCustomMessage = () =>
  helpers.withMessage("必須入力です", required);
const minLengthCustomMessage = (length) =>
  helpers.withMessage(`${length}文字以上の入力が必要です`, minLength(length));
const sameAsPasswordCustomMessage = (password) =>
  helpers.withMessage("パスワードと一致しません", sameAs(password));

const rules = computed(() => ({
  name: {
    required: requiredCustomMessage(),
  },
  email: {
    required: requiredCustomMessage(),
    email: helpers.withMessage("無効なメールアドレスです", email),
  },
  password: {
    required: requiredCustomMessage(),
    minLengthValue: minLengthCustomMessage(8),
  },
  password_confirmation: {
    required: requiredCustomMessage(),
    sameAsPassword: sameAsPasswordCustomMessage(form.password),
  },
}));
// vuelidateのインスタンス生成
const v$ = useVuelidate(rules, form);

// バリデーションの結果を表示
const getErrMessage = (fieldName) => {
  // vuelidateのエラーメッセージ
  const fieldErrors = v$.value[fieldName]?.$errors;
  if (fieldErrors && fieldErrors.length !== 0)
    return fieldErrors.map((error) => error.$message).join(", ");

  // サーバーからのエラーメッセージ
  const serverErrors = serverValidationErrMessage[fieldName];
  if (serverErrors) return serverErrors;
};

// blurEvent
const execVuelidate = (field) => {
  serverValidationErrMessage[field] = ""; // サーバーエラーメッセージ削除
  v$.value[field].$touch(); // 初回フロントバリデーション用の処理
};

// submit
const submitRegisterUser = async () => {
  loading.value = true;
  // snackbar
  let snackbarMessage, snackbarColor;
  try {
    await axios.get("/sanctum/csrf-cookie");
    const result = await axios.post("/api/register", form);
    // console.log(result); // 登録成功時のレスポンス
    // メッセージ表示
    snackbarMessage = "ユーザー登録が完了しました";
    snackbarColor = "rgba(2, 136, 209, 0.8)";
    // topへリダイレクト
    router.push({ name: "home" });
  } catch (error) {
    snackbarColor = "rgba(255, 87, 34, 0.8)";

    if (error.response.status !== 422) {
      // 422以外のエラーの場合
      snackbarMessage = "想定外のエラーが発生しました。再度お試しください";
      return;
    } else {
      // 422エラーの場合
      snackbarMessage =
        "ユーザー登録に失敗しました。エラーメッセージを確認してください";
    }

    // 422エラーの場合のみエラーメッセージを表示
    const errObject = error.response.data.errors;
    for (const key in errObject) {
      serverValidationErrMessage[key] = errObject[key][0];
      getErrMessage(key);
    }
  } finally {
    setSnackbar(snackbarMessage, snackbarColor);
    loading.value = false;
  }
};
</script>