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
          @click="submitLogin"
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
import { ref, reactive } from 'vue';
import { useApiRequest } from '../composables/useApiRequest';
import { useValidate } from '../composables/useValidation';
import { useIsLoggedIn } from '../composables/useIsLoggedIn';
import Snackbar from '../components/Snackbar.vue';

// form
const form = reactive({
  email: '',
  password: '',
});

// composables
const { loading, setLoading, apiPostRequest } =
  useApiRequest();
const { setLoginStatus } = useIsLoggedIn();
const { getErrMessage, blurExecVuelidate } =
  useValidate(form);

const showPassword = ref(false);
const isPassed = ref(false);

// submit
const submitLogin = async () => {
  setLoading(true);
  const result = await apiPostRequest('/api/login', form);

  // NOTE: 認証エラーはサーバーからのエラーメッセージは表示させないことにした
  // "ログインに失敗"文言以上のヒントは不要と判断
  if (result.status === 200) setLoginStatus(true);
  setLoading(false);
};
</script>
