<template>
  <v-sheet
    class="pa-6 mx-auto"
    max-width="700px"
    width="100vw"
  >
    <h4 class="text-center">ログイン</h4>

    <v-form v-model="isPassed" @submit.prevent>
      <v-container>
        <v-text-field
          v-model="form.email"
          :error-messages="getErrMessage('email')"
          color="primary"
          label="メールアドレス"
          prepend-inner-icon="mdi-email-outline"
          variant="underlined"
          autocomplete="username"
          @blur="blurExecVuelidate('email')"
        ></v-text-field>

        <v-text-field
          class="mb-4"
          v-model="form.password"
          :type="showPassword ? 'text' : 'password'"
          :error-messages="getErrMessage('password')"
          :append-inner-icon="
            showPassword ? 'mdi-eye' : 'mdi-eye-off'
          "
          color="primary"
          label="パスワード"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="underlined"
          autocomplete="new-password"
          @click:appendInner="showPassword = !showPassword"
          @blur="blurExecVuelidate('password')"
        ></v-text-field>

        <v-btn
          :disabled="!isPassed"
          :loading="loading"
          block
          color="blue-grey"
          size="large"
          type="submit"
          variant="elevated"
          @submit.prevent="submitLogin"
        >
          ログインする
        </v-btn>
      </v-container>
    </v-form>
  </v-sheet>
  <BaseFooter />
  <Snackbar />
</template>

<script setup>
import router from '../router';
import { ref, reactive } from 'vue';
import { useValidate } from '../composables/useValidation';
import { useSnackbar } from '../composables/useSnackbar';
import { useAxiosRequest } from '../composables/useAxiosRequest';
import { useIsLoggedIn } from '../composables/useIsLoggedIn';
import Snackbar from '../components/Snackbar.vue';

// form
const form = reactive({
  email: '',
  password: '',
});

// composables
const { setSnackbar } = useSnackbar();
const { axiosLoginPost } = useAxiosRequest();
const { getErrMessage, blurExecVuelidate } =
  useValidate(form);
const { setLoginStatus } = useIsLoggedIn();

const showPassword = ref(false);
const loading = ref(false);
const isPassed = ref(false);

// submit
const submitLogin = async () => {
  loading.value = true;
  // snackbar
  let snackbarMessage, snackbarColor;
  try {
    const result = await axiosLoginPost('/api/login', form);
    // メッセージ表示
    snackbarMessage = result.data.message;
    snackbarColor = 'rgba(2, 136, 209, 0.8)';
    setLoginStatus(true);
    // topへリダイレクト
    router.push({ name: 'home' });
  } catch (error) {
    snackbarColor = 'rgba(255, 87, 34, 0.8)';
    if (error.response.status !== 422) {
      // 422以外のエラーの場合
      snackbarMessage =
        '想定外のエラーが発生しました。再度お試しください';
    } else {
      // 422エラーの場合
      snackbarMessage = 'ログインに失敗しました';
    }
  } finally {
    setSnackbar(snackbarMessage, snackbarColor);
    loading.value = false;
  }
};
</script>
